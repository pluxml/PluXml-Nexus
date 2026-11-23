<?php

namespace Tests\Integration;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\AppTestCase;

class AppTest extends AppTestCase
{
    #[DataProvider('publicPages')]
    public function testPublicPagesAreAvailable(string $path): void
    {
        $response = $this->request('GET', $path);

        self::assertSame(200, $response->getStatusCode(), $path);
    }

    public static function publicPages(): array
    {
        return [
            ['/plugins'],
            ['/themes'],
            ['/profiles'],
            ['/auth'],
            ['/signup'],
        ];
    }

    public function testUnknownPageReturns404(): void
    {
        $response = $this->request('GET', '/this-page-does-not-exist');

        self::assertSame(404, $response->getStatusCode());
    }

    public function testProfilesListIncludesUsersWithThemesOnly(): void
    {
        $body = (string) $this->request('GET', '/profiles')->getBody();

        self::assertStringContainsString('themeonly', $body);
        self::assertStringNotContainsString('ciadmin', $body);
    }

    public function testProfilePageShowsThemes(): void
    {
        $body = (string) $this->request('GET', '/profiles/themeonly')->getBody();

        self::assertStringContainsString('ci-theme', $body);
        self::assertStringContainsString('<h3>Themes:</h3>', $body);
        self::assertStringNotContainsString('No themes found', $body);
    }

    public function testLoginGrantsBackofficeAccessAndLogoutRevokesIt(): void
    {
        $loginPage = (string) $this->request('GET', '/auth')->getBody();

        preg_match('/name="csrf_name" value="([^"]+)"/', $loginPage, $name);
        preg_match('/name="csrf_value" value="([^"]+)"/', $loginPage, $value);

        self::assertNotEmpty($name[1] ?? null, 'CSRF token name is missing');
        self::assertNotEmpty($value[1] ?? null, 'CSRF token value is missing');

        $response = $this->request('POST', '/auth/login', [
            'csrf_name'  => $name[1],
            'csrf_value' => $value[1],
            'username'   => 'ciadmin',
            'password'   => 'Test1234!',
        ]);

        self::assertSame(302, $response->getStatusCode());
        self::assertSame('/backoffice', $response->getHeaderLine('Location'));
        self::assertSame(200, $this->request('GET', '/backoffice')->getStatusCode());

        $response = $this->request('GET', '/auth/logout');
        self::assertSame(302, $response->getStatusCode());
        self::assertSame('/', $response->getHeaderLine('Location'));

        $response = $this->request('GET', '/backoffice');
        self::assertSame(302, $response->getStatusCode());
        self::assertSame('/auth', $response->getHeaderLine('Location'));
    }
}
