import './bootstrap';

const navToggle = document.querySelector('[data-nav-toggle]');
const navMenu = document.querySelector('[data-nav-menu]');

if (navToggle && navMenu) {
    navToggle.addEventListener('click', () => {
        navMenu.classList.toggle('is-open');
    });
}

document.querySelectorAll('form[data-confirm]').forEach((form) => {
    form.addEventListener('submit', (event) => {
        const message = form.getAttribute('data-confirm');

        if (message && !window.confirm(message)) {
            event.preventDefault();
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

    const update = () => {
        const downPayment = Number(downPaymentInput.value);
        const term = Number(termInput.value);
        const rate = Number(rateInput.value);

        downPaymentValue.textContent = `${downPayment}%`;
        termValue.textContent = `${term} мес.`;
        rateValue.textContent = `${rate}%`;

        const payment = calculateMonthlyPayment(price, downPayment, term, rate);
        monthlyPayment.textContent = formatCurrency(payment);
    };

    [downPaymentInput, termInput, rateInput].forEach((input) => {
        input.addEventListener('input', update);
    });

    update();
});
