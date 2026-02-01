
document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById("authModal");
    const profileBtn = document.getElementById("loginTrigger");
    const otherTriggers = document.querySelectorAll(".login-trigger");
    const closeBtn = document.querySelector(".close-modal");

    if (!modal) return; 

    function openModal(e) {
        if(e) e.preventDefault();
        modal.style.display = "flex";
    }

    function closeModal() {
        modal.style.display = "none";
    }

    if (profileBtn) profileBtn.addEventListener("click", openModal);
    
    otherTriggers.forEach(btn => btn.addEventListener("click", openModal));

    if (closeBtn) closeBtn.addEventListener("click", closeModal);

    window.addEventListener("click", (e) => {
        if (e.target === modal) closeModal();
    });
});