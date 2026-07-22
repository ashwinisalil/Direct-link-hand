// ===========================================================
// Direct Link Hands - Base JavaScript
// ===========================================================

document.addEventListener('DOMContentLoaded', function () {

    // Auto-hide alert messages after 5 seconds
    document.querySelectorAll('.alert').forEach(function (alertBox) {
        setTimeout(function () {
            alertBox.style.transition = 'opacity 0.5s ease';
            alertBox.style.opacity = '0';
            setTimeout(function () {
                alertBox.remove();
            }, 500);
        }, 5000);
    });

    // Basic client-side confirmation for delete/reject links
    document.querySelectorAll('a.btn-danger').forEach(function (link) {
        link.addEventListener('click', function (e) {
            if (!confirm('Are you sure you want to proceed? This action cannot be undone.')) {
                e.preventDefault();
            }
        });
    });

    // Donation amount quick-select buttons (used if added to donate.php)
    document.querySelectorAll('[data-amount]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var amountField = document.getElementById('amount');
            if (amountField) {
                amountField.value = btn.getAttribute('data-amount');
            }
        });
    });

    // Sync the registration ticket label/button on initial load
    var checkedReg = document.querySelector('input[name="reg_type_display"]:checked');
    if (checkedReg) {
        toggleRegType(checkedReg.value);
    }

});

// Toggle between Donor and Organization registration fieldsets
function toggleRegType(type) {
    var donorFields = document.getElementById('donor-fields');
    var orgFields   = document.getElementById('org-fields');
    var hiddenInput = document.getElementById('reg_type');
    var ticketType  = document.getElementById('reg-ticket-type');
    var submitBtn   = document.getElementById('reg-submit-btn');

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

    if (hiddenInput) hiddenInput.value = type;

    document.querySelectorAll('.reg-toggle-option').forEach(function (label) {
        var input = label.querySelector('input');
        if (input && input.value === type) {
            label.classList.add('active');
        } else {
            label.classList.remove('active');
        }
    });
}
