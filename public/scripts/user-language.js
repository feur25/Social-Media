

function setUserLanguage(name) {
    document.cookie = "language=" + name + "; path=/";
}


document.getElementById("user-language-form").addEventListener(
    "change", 
    function() {
        setUserLanguage(this.value);
        location.reload();
    }
);