const logout = document.getElementById("logout")
logout.addEventListener("click", async (e) => {
    e.preventDefault()
    try {
        const response = await fetch(`/classes/Authentication.php?f=logout`)
        const json = await response.json();
        if (json.logout) {
            location.href = "/login.php"
        }
    } catch (e) {
        console.log(e);
    }
})