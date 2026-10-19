/* =========================================
   AROMA - MAIN JAVASCRIPT
========================================= */


/* =========================================
   1. PAGE LOAD
========================================= */

document.addEventListener('DOMContentLoaded', function () {

    console.log('AROMA website loaded successfully.');

});


/* =========================================
   2. PRODUCT CATEGORY FILTER
========================================= */

const filterButtons = document.querySelectorAll('.filter-btn');
const productItems = document.querySelectorAll('.product-item');

filterButtons.forEach(function (button) {

    button.addEventListener('click', function () {

        // Remove active class from all buttons
        filterButtons.forEach(function (btn) {
            btn.classList.remove('active');
        });

        // Add active class to clicked button
        this.classList.add('active');

        const selectedCategory = this.getAttribute('data-category');

        productItems.forEach(function (product) {

            const productCategory = product.getAttribute('data-category');

            if (
                selectedCategory === 'all' ||
                productCategory === selectedCategory
            ) {
                product.style.display = 'block';
            } else {
                product.style.display = 'none';
            }

        });

    });

});


/* =========================================
   3. PRODUCT BUTTON ALERT
========================================= */

const aromaActionButtons = document.querySelectorAll('.aroma-action-btn');

aromaActionButtons.forEach(function (button) {

    button.addEventListener('click', function () {

        alert('Thank you for choosing AROMA!');

    });

});