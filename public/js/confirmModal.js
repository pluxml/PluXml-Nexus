function confirmModal(username, request) {
    let r = confirm("Are you sure to remove "+username);
    let txt;
    if (r == true) {
        fetch(request).then(response => document.location.reload(true));
    }
}