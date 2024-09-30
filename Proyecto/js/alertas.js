document.addEventListener("DOMContentLoaded", function() {
    const params = new URLSearchParams(window.location.search);
    const status = params.get("status");

    if (status === "registroexitoso") {
        alert("Registro exitoso.");
   
    } 
});