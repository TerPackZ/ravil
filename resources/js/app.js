import './bootstrap';

const navToggle = document.querySelector('[data-nav-toggle]');
const navMenu = document.querySelector('[data-nav-menu]');

const closeNavMenu = () => {
    if (!navMenu || !navToggle) {
        return;
    }

    navMenu.classList.remove('is-open');
    navToggle.setAttribute('aria-expanded', 'false');
};

if (navToggle && navMenu) {
    navToggle.addEventListener('click', () => {
        const isOpen = navMenu.classList.toggle('is-open');
        navToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });

    document.addEventListener('click', (event) => {
        if (!navMenu.classList.contains('is-open')) {
            return;
        }

        if (navMenu.contains(event.target) || navToggle.contains(event.target)) {
            return;
        }

        closeNavMenu();
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeNavMenu();
        }
    });

    navMenu.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', closeNavMenu);
    });
}

const adminSidebar = document.querySelector('[data-admin-sidebar]');
const adminSidebarToggle = document.querySelector('[data-admin-sidebar-toggle]');

if (adminSidebar && adminSidebarToggle) {
    const closeAdminSidebar = () => {
        adminSidebar.classList.remove('is-open');
        adminSidebarToggle.setAttribute('aria-expanded', 'false');
    };

    adminSidebarToggle.addEventListener('click', () => {
        const isOpen = adminSidebar.classList.toggle('is-open');
        adminSidebarToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });

    document.addEventListener('click', (event) => {
        if (!adminSidebar.classList.contains('is-open')) {
            return;
        }

        if (adminSidebar.contains(event.target) || adminSidebarToggle.contains(event.target)) {
            return;
        }

        closeAdminSidebar();
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeAdminSidebar();
        }
    });
}

document.querySelectorAll('[data-flash-dismiss]').forEach((button) => {
    button.addEventListener('click', () => {
        const alert = button.closest('.flash-alert');

        if (alert) {
            alert.remove();
        }
    });
});

document.querySelectorAll('form[data-confirm]').forEach((form) => {
    form.addEventListener('submit', (event) => {
        const message = form.getAttribute('data-confirm');

        if (message && !window.confirm(message)) {
            event.preventDefault();
            return;
        }

        const submitButton = form.querySelector('[type="submit"]');

        if (submitButton) {
            submitButton.disabled = true;
        }
    });
});

const formatCurrency = (value) => new Intl.NumberFormat('ru-RU', {
    style: 'currency',
    currency: 'RUB',
    maximumFractionDigits: 0,
}).format(value);

const calculateMonthlyPayment = (price, downPaymentPercent, months, annualRate) => {
    if (months <= 0) {
        return 0;
    }

    const loanAmount = price * (1 - downPaymentPercent / 100);

    if (loanAmount <= 0) {
        return 0;
    }

    if (annualRate <= 0) {
        return loanAmount / months;
    }

    const monthlyRate = annualRate / 100 / 12;
    const factor = (1 + monthlyRate) ** months;

    return loanAmount * (monthlyRate * factor) / (factor - 1);
};

document.querySelectorAll('[data-credit-calculator]').forEach((calculator) => {
    const price = Number(calculator.dataset.price || 0);
    const downPaymentInput = calculator.querySelector('[data-down-payment]');
    const termInput = calculator.querySelector('[data-term]');
    const rateInput = calculator.querySelector('[data-rate]');
    const downPaymentValue = calculator.querySelector('[data-down-payment-value]');
    const termValue = calculator.querySelector('[data-term-value]');
    const rateValue = calculator.querySelector('[data-rate-value]');
    const monthlyPayment = calculator.querySelector('[data-monthly-payment]');

    if (!downPaymentInput || !termInput || !rateInput || !monthlyPayment) {
        return;
    }

    const update = () => {
        const downPayment = Number(downPaymentInput.value);
        const term = Number(termInput.value);
        const rate = Number(rateInput.value);

        if (downPaymentValue) {
            downPaymentValue.textContent = `${downPayment}%`;
        }

        downPaymentInput.setAttribute('aria-valuenow', String(downPayment));
        downPaymentInput.setAttribute('aria-valuetext', `${downPayment}%`);

        if (termValue) {
            termValue.textContent = `${term} мес.`;
        }

        termInput.setAttribute('aria-valuenow', String(term));
        termInput.setAttribute('aria-valuetext', `${term} месяцев`);

        if (rateValue) {
            rateValue.textContent = `${rate}%`;
        }

        rateInput.setAttribute('aria-valuenow', String(rate));
        rateInput.setAttribute('aria-valuetext', `${rate}%`);

        monthlyPayment.textContent = formatCurrency(
            calculateMonthlyPayment(price, downPayment, term, rate)
        );
    };

    [downPaymentInput, termInput, rateInput].forEach((input) => {
        input.addEventListener('input', update);
    });

    update();
});
