document.addEventListener('keydown', function (event) {
    if (event.ctrlKey && event.keyCode == 85 || event.ctrlKey && event.shiftKey && event.keyCode == 67 || event.ctrlKey && event.shiftKey && event.keyCode == 74 || event.ctrlKey && event.shiftKey && event.keyCode == 73 || event.keyCode == 123) {
        event.preventDefault();
    }
})