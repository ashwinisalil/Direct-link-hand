// ===========================================================
// Direct Link Hands - Base JavaScript
//
// Everything here waits for DOMContentLoaded, which fires once
// the page's HTML has fully loaded (but before images etc. finish) -
// this guarantees the elements we're looking for actually exist
// before we try to grab them with document.querySelector().
// ===========================================================

document.addEventListener('DOMContentLoaded', function () {

    // ---- Auto-hide success/error alert messages after 5 seconds ----
    document.querySelectorAll('.alert').forEach(function (alertBox) {
        setTimeout(function () {
            alertBox.style.transition = 'opacity 0.5s ease';
            alertBox.style.opacity = '0';
            // Wait for the fade-out animation to finish before removing
            // the element completely, so it disappears smoothly.
            setTimeout(function () {
                alertBox.remove();
            }, 500);
        }, 5000);
    });

    // ---- Confirmation pop-up on any "Delete" style button ----
    // Applies to every link/button using the .btn-danger class
    // (used on admin/users.php and admin/organizations.php delete links).
    document.querySelectorAll('a.btn-danger').forEach(function (link) {
        link.addEventListener('click', function (e) {
            if (!confirm('Are you sure you want to proceed? This action cannot be undone.')) {
                e.preventDefault(); // cancels the link/navigation if they click "Cancel"
            }
        });
    });

    // ---- Donation amount quick-select buttons ----
    // Not currently used on any page, but ready if you add
    // buttons like <button data-amount="500">₹500</button> to donate.php
    document.querySelectorAll('[data-amount]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var amountField = document.getElementById('amount');
            if (amountField) {
                amountField.value = btn.getAttribute('data-amount');
            }
        });
    });

    // ---- Registration page: make sure the correct tab is active on load ----
    // (matters if the page reloaded after a failed submission — we want
    // the same tab the user was filling in to still be showing)
    var checkedReg = document.querySelector('input[name="reg_type_display"]:checked');
    if (checkedReg) {
        toggleRegType(checkedReg.value);
    }

});

/**
 * toggleRegType(type)
 * Used only on register.php. Switches between the "Donor" and
 * "Organization" registration fieldsets when the user clicks a tab.
 * Called directly from the onchange="" attribute on each radio button
 * in register.php, and once automatically on page load (see above).
 *
 * @param {string} type - either 'donor' or 'organization'
 */
function toggleRegType(type) {
    var donorFields = document.getElementById('donor-fields');
    var orgFields   = document.getElementById('org-fields');
    var hiddenInput = document.getElementById('reg_type');
    var ticketType  = document.getElementById('reg-ticket-type');
    var submitBtn   = document.getElementById('reg-submit-btn');

    // Safety check: if these elements don't exist (e.g. we're on a
    // different page), just do nothing instead of throwing an error.
    if (!donorFields || !orgFields) return;

    if (type === 'organization') {
        donorFields.style.display = 'none';
        orgFields.style.display = 'block';
        if (ticketType) ticketType.textContent = 'Organization';
        if (submitBtn) submitBtn.textContent = 'Submit for Review';
    } else {
        donorFields.style.display = 'block';
        orgFields.style.display = 'none';
        if (ticketType) ticketType.textContent = 'Donor';
        if (submitBtn) submitBtn.textContent = 'Register as Donor';
    }

    // Keep the hidden form field in sync, so PHP knows which set of
    // fields to read from $_POST when the form is submitted.
    if (hiddenInput) hiddenInput.value = type;

    // Highlight whichever tab is currently active (visual styling only)
    document.querySelectorAll('.reg-toggle-option').forEach(function (label) {
        var input = label.querySelector('input');
        if (input && input.value === type) {
            label.classList.add('active');
        } else {
            label.classList.remove('active');
        }
    });
}
