// Safely select the navbar
let navbar = document.querySelector('.header_navigation .header_navbar');
let accbox = document.querySelector('.header_acc_box');

// Menu button functionality
let menuBtn = document.getElementById('menu_btn');
if (menuBtn && navbar) {
  menuBtn.onclick = () => {
    navbar.classList.toggle('active');
    if (accbox) accbox.classList.remove('active');
  };
}

// User button functionality
let userBtn = document.getElementById('user_btn');
if (userBtn && accbox) {
  userBtn.onclick = () => {
    accbox.classList.toggle('active');
    if (navbar) navbar.classList.remove('active');
  };
}

// Scroll behavior
window.onscroll = () => {
  if (navbar) navbar.classList.remove('active');
  if (accbox) accbox.classList.remove('active');
};

// Close update functionality
let closeUpdateBtn = document.querySelector('#close_update');
if (closeUpdateBtn) {
  closeUpdateBtn.onclick = () => {
    let editProductForm = document.querySelector('.edit_product_form');
    if (editProductForm) {
      editProductForm.style.display = 'none';
    }
    window.location.href = "Admin_Products.php";
  };
}
