@if(session('success') || session('error') || $errors->any())
    <div class="flash-messages" data-flash-messages aria-live="polite">
        @if(session('success'))
            <div class="alert success flash-alert" role="status">
                <span>{{ session('success') }}</span>
                <button type="button" class="flash-dismiss" data-flash-dismiss aria-label="Закрыть">×</button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert error flash-alert" role="alert">
                <span>{{ session('error') }}</span>
                <button type="button" class="flash-dismiss" data-flash-dismiss aria-label="Закрыть">×</button>
            </div>
        @endif
        @if($errors->any())
            <div class="alert error flash-alert" role="alert">
                <div>
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
                <button type="button" class="flash-dismiss" data-flash-dismiss aria-label="Закрыть">×</button>
            </div>
        @endif
    </div>
@endif
