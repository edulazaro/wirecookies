@props([
    'policyUrl' => null,
    'delay' => null,
    'categories' => null,
    'storageKey' => null,

    // Textos
    'title' => 'Configuración de cookies',
    'description' => 'Usamos cookies propias y de terceros para analizar el uso de la web y mejorar nuestros servicios. Puedes aceptarlas todas, rechazarlas o configurar tus preferencias.',
    'acceptAll' => 'Aceptar todo',
    'rejectAll' => 'Rechazar todo',
    'configure' => 'Configurar',
    'savePreferences' => 'Guardar preferencias',
    'rejectOptional' => 'Rechazar opcionales',
    'morePolicy' => 'Más información',
    'modalTitle' => 'Preferencias de cookies',
    'alwaysActive' => 'Siempre activas',
])

@php
    $policyUrl  = $policyUrl  ?? config('wirecookies.policy_url');
    $delay      = $delay      ?? config('wirecookies.delay', 800);
    $categories = $categories ?? config('wirecookies.categories', []);
    $storageKey = $storageKey ?? config('wirecookies.storage_key', 'cookie-preferences');

    // Defaults para localStorage (todas las required = true).
    $defaults = collect($categories)
        ->map(fn ($c) => $c['default'] ?? ($c['required'] ?? false))
        ->all();
@endphp

<div
    class="wc-root"
    x-data="{
        showBanner: false,
        hasSaved: false,
        preferences: @js((object) $defaults),
        init() {
            const saved = localStorage.getItem(@js($storageKey));
            if (!saved) {
                setTimeout(() => this.showBanner = true, {{ (int) $delay }});
            } else {
                this.hasSaved = true;
                try {
                    const parsed = JSON.parse(saved);
                    Object.assign(this.preferences, parsed);
                } catch (e) {}
            }
        },
        acceptAll() {
            for (const key in this.preferences) this.preferences[key] = true;
            this.save();
        },
        rejectAll() {
            @foreach($categories as $key => $cat)
                this.preferences[@js($key)] = {{ ($cat['required'] ?? false) ? 'true' : 'false' }};
            @endforeach
            this.save();
        },
        savePreferences() {
            this.save();
            if (window.Wiremodal) Wiremodal.close('wirecookies-preferences');
        },
        save() {
            localStorage.setItem(@js($storageKey), JSON.stringify(this.preferences));
            this.showBanner = false;
            this.hasSaved = true;
            this.$dispatch('wirecookies-saved', this.preferences);
        },
        openSettings() {
            if (window.Wiremodal) Wiremodal.open('wirecookies-preferences');
        },
    }"
    x-cloak
>
    {{-- Botón flotante: aparece cuando el banner no está visible y el user
         ya guardó preferencias (AEPD: poder retirar/modificar consentimiento). --}}
    <button
        x-show="!showBanner && hasSaved"
        @click="openSettings()"
        type="button"
        aria-label="{{ $title }}"
        title="{{ $title }}"
        class="wc-floating"
        x-transition:enter="transition ease-out duration-200 delay-300"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
    >
        <svg class="wc-floating-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M21.6 12.4a4 4 0 0 1-4-4 4 4 0 0 1-4-4 9 9 0 1 0 8 8z" stroke-linecap="round" stroke-linejoin="round"/>
            <circle cx="8.5" cy="10.5" r="0.9" fill="currentColor"/>
            <circle cx="13" cy="14.5" r="0.9" fill="currentColor"/>
            <circle cx="9" cy="16" r="0.9" fill="currentColor"/>
            <circle cx="15.5" cy="11" r="0.7" fill="currentColor"/>
        </svg>
    </button>

    {{-- Banner --}}
    <div
        x-show="showBanner"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="translate-y-full"
        x-transition:enter-end="translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="translate-y-0"
        x-transition:leave-end="translate-y-full"
        class="wc-banner"
    >
        <div class="wc-banner-inner">
            <div class="wc-banner-text">
                <h3 class="wc-banner-title">{{ $title }}</h3>
                <p class="wc-banner-description">
                    {{ $description }}
                    @if($policyUrl)
                        <a href="{{ $policyUrl }}" class="wc-banner-link">{{ $morePolicy }}</a>
                    @endif
                </p>
            </div>

            <div class="wc-banner-actions">
                <button @click="openSettings()" type="button" class="wc-btn wc-btn-secondary">
                    {{ $configure }}
                </button>
                <button @click="rejectAll()" type="button" class="wc-btn wc-btn-muted">
                    {{ $rejectAll }}
                </button>
                <button @click="acceptAll()" type="button" class="wc-btn wc-btn-primary">
                    {{ $acceptAll }}
                </button>
            </div>
        </div>
    </div>

    {{-- Modal de preferencias (wiremodal — hereda el data-wire-theme global) --}}
    <x-wiremodal name="wirecookies-preferences" size="2xl" :title="$modalTitle">
        <x-slot:body>
            <div class="wc-categories">
                @foreach($categories as $key => $cat)
                    <div class="wc-category {{ ($cat['required'] ?? false) ? 'wc-category-required' : '' }}">
                        <div class="wc-category-header">
                            <h3 class="wc-category-label">{{ $cat['label'] }}</h3>
                            @if($cat['required'] ?? false)
                                <span class="wc-category-badge">{{ $alwaysActive }}</span>
                            @else
                                <label class="wc-toggle">
                                    <input type="checkbox" x-model="preferences['{{ $key }}']" class="wc-toggle-input">
                                    <div class="wc-toggle-track"></div>
                                </label>
                            @endif
                        </div>
                        <p class="wc-category-description">{{ $cat['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </x-slot:body>

        <x-slot:footer>
            <div class="wc-modal-footer">
                @if($policyUrl)
                    <a href="{{ $policyUrl }}" class="wc-modal-policy-link">
                        Ver política completa
                    </a>
                @else
                    <span></span>
                @endif
                <div class="wc-modal-actions">
                    <button @click="rejectAll(); Wiremodal.close('wirecookies-preferences')" type="button" class="wc-btn wc-btn-muted">
                        {{ $rejectOptional }}
                    </button>
                    <button @click="savePreferences()" type="button" class="wc-btn wc-btn-primary">
                        {{ $savePreferences }}
                    </button>
                </div>
            </div>
        </x-slot:footer>
    </x-wiremodal>
</div>
