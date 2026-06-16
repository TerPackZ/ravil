<div class="panel credit-calculator" data-credit-calculator data-price="{{ $car->price }}">
    <h2>Кредитный калькулятор</h2>
    <p class="record-meta">Рассчитайте ориентировочный ежемесячный платёж</p>

    <label class="calc-label" for="calc-down-payment">
        Первоначальный взнос: <strong data-down-payment-value>20%</strong>
    </label>
    <input id="calc-down-payment" type="range" data-down-payment min="0" max="50" step="5" value="20" aria-valuemin="0" aria-valuemax="50" aria-valuenow="20" aria-valuetext="20%">

    <label class="calc-label" for="calc-term">
        Срок кредита: <strong data-term-value>36 мес.</strong>
    </label>
    <input id="calc-term" type="range" data-term min="12" max="84" step="12" value="36" aria-valuemin="12" aria-valuemax="84" aria-valuenow="36" aria-valuetext="36 месяцев">

    <label class="calc-label" for="calc-rate">
        Ставка: <strong data-rate-value>12%</strong> годовых
    </label>
    <input id="calc-rate" type="range" data-rate min="5" max="25" step="0.5" value="12" aria-valuemin="5" aria-valuemax="25" aria-valuenow="12" aria-valuetext="12%">

    <div class="calc-result">
        <span>Ежемесячный платёж</span>
        <strong data-monthly-payment aria-live="polite">—</strong>
    </div>
    <p class="record-meta">Расчёт носит ознакомительный характер и не является публичной офертой.</p>
</div>
