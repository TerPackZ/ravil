<div class="panel credit-calculator" data-credit-calculator data-price="{{ $car->price }}">
    <h2>Кредитный калькулятор</h2>
    <p class="record-meta">Рассчитайте ориентировочный ежемесячный платёж</p>

    <label class="calc-label">
        Первоначальный взнос: <strong data-down-payment-value>20%</strong>
    </label>
    <input type="range" data-down-payment min="0" max="50" step="5" value="20">

    <label class="calc-label">
        Срок кредита: <strong data-term-value>36 мес.</strong>
    </label>
    <input type="range" data-term min="12" max="84" step="12" value="36">

    <label class="calc-label">
        Ставка: <strong data-rate-value>12%</strong> годовых
    </label>
    <input type="range" data-rate min="5" max="25" step="0.5" value="12">

    <div class="calc-result">
        <span>Ежемесячный платёж</span>
        <strong data-monthly-payment>—</strong>
    </div>
    <p class="record-meta">Расчёт носит ознакомительный характер и не является публичной офертой.</p>
</div>
