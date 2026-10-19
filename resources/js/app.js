/* =========================================================
   AROMA - MAIN JAVASCRIPT
   ========================================================= */

document.addEventListener('DOMContentLoaded', function () {

    const prefersReducedMotion = window.matchMedia(
        '(prefers-reduced-motion: reduce)'
    ).matches;

    /* =====================================================
       TOAST NOTIFICATIONS
       ===================================================== */

    function getToastContainer() {
        let container = document.querySelector('.aroma-toasts');

        if (!container) {
            container = document.createElement('div');
            container.className = 'aroma-toasts';
            container.setAttribute('aria-live', 'polite');
            container.setAttribute('aria-atomic', 'true');
            document.body.appendChild(container);
        }

        return container;
    }

    function dismissToast(toast) {
        toast.classList.add('is-hiding');

        setTimeout(function () {
            toast.remove();
        }, 320);
    }

    function showToast(message, type) {
        const container = getToastContainer();
        const toast = document.createElement('div');

        toast.className = 'aroma-toast aroma-toast--' + (type || 'success');
        toast.setAttribute('role', type === 'error' ? 'alert' : 'status');

        toast.innerHTML =
            '<i class="bi ' +
            (type === 'error' ? 'bi-exclamation-circle' : 'bi-check-circle') +
            '" aria-hidden="true"></i>' +
            '<p></p>' +
            '<button type="button" class="aroma-toast-close" aria-label="Dismiss notification">' +
            '<i class="bi bi-x-lg" aria-hidden="true"></i></button>';

        toast.querySelector('p').textContent = message;

        toast.querySelector('.aroma-toast-close')
            .addEventListener('click', function () {
                dismissToast(toast);
            });

        container.appendChild(toast);

        setTimeout(function () {
            if (toast.isConnected) {
                dismissToast(toast);
            }
        }, 6000);
    }

    document.querySelectorAll('.aroma-toast').forEach(function (toast) {
        const close = toast.querySelector('.aroma-toast-close');

        if (close) {
            close.addEventListener('click', function () {
                dismissToast(toast);
            });
        }

        setTimeout(function () {
            if (toast.isConnected) {
                dismissToast(toast);
            }
        }, 6000);
    });


    /* =====================================================
       CART QUANTITY AUTO UPDATE
       ===================================================== */

    function formatMoney(value) {
        return '₹' + Number(String(value == null ? 0 : value).replace(/,/g, '')).toLocaleString('en-IN', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    function updateCartSummary(summary) {
        if (!summary) {
            return;
        }

        document.querySelectorAll('[data-cart-subtotal]').forEach(function (el) {
            el.textContent = formatMoney(summary.subtotal);
        });

        document.querySelectorAll('[data-cart-total]').forEach(function (el) {
            el.textContent = formatMoney(summary.total);
        });

        document.querySelectorAll('[data-cart-shipping]').forEach(function (el) {
            if (Number(summary.shipping) > 0) {
                el.textContent = formatMoney(summary.shipping);
                el.classList.remove('text-success');
            } else {
                el.textContent = 'FREE';
                el.classList.add('text-success');
            }
        });

        document.querySelectorAll('[data-cart-header-count]').forEach(function (el) {
            el.textContent = summary.items + (Number(summary.items) === 1 ? ' Item' : ' Items');
        });

        const badge = document.querySelector('.cart-badge');

        if (badge) {
            if (Number(summary.items) > 0) {
                badge.textContent = summary.items;
            } else {
                badge.remove();
            }
        }
    }

    document.querySelectorAll('[data-cart-update]').forEach(function (form) {
        const input = form.querySelector('.quantity-input');

        if (!input) {
            return;
        }

        const max = parseInt(input.max, 10) || 999;
        const status = form.querySelector('[data-cart-status]');
        let timer = null;

        function submitUpdate() {
            const quantity = Math.max(1, Math.min(parseInt(input.value, 10) || 1, max));

            input.value = quantity;

            const body = new URLSearchParams(new FormData(form));

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: body
            })
                .then(function (response) {
                    return response.json().then(function (data) {
                        return { ok: response.ok, data: data };
                    });
                })
                .then(function (result) {
                    if (!result.ok || !result.data.success) {
                        showToast(
                            result.data.message || 'Unable to update the cart.',
                            'error'
                        );
                        return;
                    }

                    const item = form.closest('[data-cart-item]');
                    const line = item ? item.querySelector('[data-line-subtotal]') : null;

                    if (line && result.data.line) {
                        line.textContent = formatMoney(result.data.line.subtotal);
                    }

                    updateCartSummary(result.data.summary);

                    if (status) {
                        status.textContent = 'Cart updated.';
                    }
                })
                .catch(function () {
                    showToast('Unable to update the cart. Please try again.', 'error');
                });
        }

        form.querySelectorAll('.quantity-btn').forEach(function (button) {
            button.addEventListener('click', function () {
                const step = parseInt(button.dataset.step, 10) || 0;
                const current = parseInt(input.value, 10) || 1;

                input.value = Math.max(1, Math.min(current + step, max));

                clearTimeout(timer);
                timer = setTimeout(submitUpdate, 250);
            });
        });

        input.addEventListener('change', function () {
            clearTimeout(timer);
            timer = setTimeout(submitUpdate, 250);
        });
    });


    /* =====================================================
       AUTO SUBMIT FILTERS
       ===================================================== */

    document.querySelectorAll('.auto-submit').forEach(function (field) {
        field.addEventListener('change', function () {
            if (!field.form) {
                return;
            }

            if (typeof field.form.requestSubmit === 'function') {
                field.form.requestSubmit();
            } else {
                field.form.submit();
            }
        });
    });


    /* =====================================================
       REVEAL ON SCROLL
       ===================================================== */

    const revealTargets = document.querySelectorAll(
        '.section-heading, .product-card, .collection-card, .feature-card, ' +
        '.review-card, .admin-stat-card, .admin-section-card, .filter-box, ' +
        '.cart-card, .cart-summary, .checkout-card, .checkout-summary, ' +
        '.profile-card, .profile-sidebar, .orders-card, .order-details-card, ' +
        '.order-summary-card, .newsletter-box, .auth-card, .about-quote, ' +
        '.dark-info-card, .contact-form-card'
    );

    if (!prefersReducedMotion && 'IntersectionObserver' in window) {
        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

        revealTargets.forEach(function (target) {
            target.classList.add('reveal');
            observer.observe(target);
        });
    }


    /* =====================================================
       BACK TO TOP
       ===================================================== */

    const backToTop = document.createElement('button');

    backToTop.type = 'button';
    backToTop.className = 'back-to-top';
    backToTop.setAttribute('aria-label', 'Back to top');
    backToTop.innerHTML = '<i class="bi bi-arrow-up" aria-hidden="true"></i>';
    document.body.appendChild(backToTop);

    function toggleBackToTop() {
        backToTop.classList.toggle('is-visible', window.scrollY > 500);
    }

    backToTop.addEventListener('click', function () {
        window.scrollTo({ top: 0, behavior: prefersReducedMotion ? 'auto' : 'smooth' });
    });

    window.addEventListener('scroll', toggleBackToTop, { passive: true });
    toggleBackToTop();


    /* =====================================================
       DELETE CONFIRMATION
       ===================================================== */

    document.querySelectorAll('.delete-confirm').forEach(function (form) {
        form.addEventListener('submit', function (event) {
            const confirmed = confirm(
                'Are you sure you want to delete this item?'
            );

            if (!confirmed) {
                event.preventDefault();
            }
        });
    });


    /* =====================================================
       QUANTITY CONTROLS (non-cart forms)
       ===================================================== */

    document.querySelectorAll('.quantity-minus').forEach(function (button) {
        button.addEventListener('click', function () {
            const input = this.parentElement.querySelector('input[type="number"]');

            if (!input) {
                return;
            }

            const value = parseInt(input.value) || 1;
            const min = parseInt(input.min) || 1;

            if (value > min) {
                input.value = value - 1;
                input.dispatchEvent(new Event('change'));
            }
        });
    });

    document.querySelectorAll('.quantity-plus').forEach(function (button) {
        button.addEventListener('click', function () {
            const input = this.parentElement.querySelector('input[type="number"]');

            if (!input) {
                return;
            }

            const value = parseInt(input.value) || 1;
            const max = parseInt(input.max) || 999;

            if (value < max) {
                input.value = value + 1;
                input.dispatchEvent(new Event('change'));
            }
        });
    });


    /* =====================================================
       IMAGE PREVIEW
       ===================================================== */

    document.querySelectorAll('input[type="file"][data-preview]').forEach(function (input) {
        input.addEventListener('change', function () {
            const previewId = this.dataset.preview;
            const preview = document.getElementById(previewId);

            if (!preview || !this.files || !this.files[0]) {
                return;
            }

            const file = this.files[0];

            if (!file.type.startsWith('image/')) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {
                preview.src = event.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(file);
        });
    });


    /* =====================================================
       SMOOTH SCROLL
       ===================================================== */

    document.querySelectorAll('a[href^="#"]').forEach(function (link) {
        link.addEventListener('click', function (event) {
            const targetId = this.getAttribute('href');

            if (!targetId || targetId === '#') {
                return;
            }

            const target = document.querySelector(targetId);

            if (target) {
                event.preventDefault();
                target.scrollIntoView({
                    behavior: prefersReducedMotion ? 'auto' : 'smooth',
                    block: 'start'
                });
            }
        });
    });


    /* =====================================================
       BOOTSTRAP TOOLTIPS
       ===================================================== */

    if (typeof bootstrap !== 'undefined') {
        document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (element) {
            new bootstrap.Tooltip(element);
        });
    }


    /* =====================================================
       DISABLE BUTTON AFTER FORM SUBMIT
       ===================================================== */

    document.querySelectorAll('form[data-disable-submit]').forEach(function (form) {
        form.addEventListener('submit', function () {
            const submitButton = form.querySelector(
                'button[type="submit"], input[type="submit"]'
            );

            if (!submitButton) {
                return;
            }

            submitButton.disabled = true;

            const originalText = submitButton.innerHTML;

            submitButton.innerHTML =
                '<span class="spinner-border spinner-border-sm me-2"></span>' +
                'Please wait...';

            setTimeout(function () {
                submitButton.disabled = false;
                submitButton.innerHTML = originalText;
            }, 10000);
        });
    });

});
