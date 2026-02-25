{{--
    ============================================================
    PARTIAL: resources/views/partials/weather.blade.php
    Cuaca Real-Time 7 Hari — Polres Gunungkidul
    API  : Open-Meteo (gratis, tanpa API key)
    Lokasi : Gunungkidul, D.I. Yogyakarta
    ============================================================

    CARA PAKAI di home.blade.php (letakkan sebelum section sosial media):
        @include('partials.weather')

    TIDAK perlu perubahan backend / controller apapun.
    ============================================================
--}}

{{-- ===== WEATHER SECTION ===== --}}
<section class="weather-section" id="cuaca">
    <div class="section-wrap">

        {{-- Header --}}
        <div class="section-header fade-up">
            <span class="eyebrow">Prakiraan Cuaca</span>
            <h2>Cuaca Gunungkidul</h2>
            <p>Informasi cuaca real-time 7 hari ke depan untuk wilayah Kabupaten Gunungkidul.</p>
            <div class="section-divider"></div>
        </div>

        {{-- Current Weather Card --}}
        <div class="wx-current fade-up" id="wxCurrent">
            <div class="wx-current-left">
                <div class="wx-current-icon" id="wxCurrentIcon">⏳</div>
                <div class="wx-current-info">
                    <div class="wx-current-temp" id="wxCurrentTemp">--°C</div>
                    <div class="wx-current-desc" id="wxCurrentDesc">Memuat data…</div>
                    <div class="wx-current-loc">📍 Gunungkidul, D.I. Yogyakarta</div>
                </div>
            </div>
            <div class="wx-current-right" id="wxCurrentRight">
                <div class="wx-meta-item"><span class="wx-meta-label">Kelembaban</span><span class="wx-meta-val" id="wxHumidity">--</span></div>
                <div class="wx-meta-item"><span class="wx-meta-label">Angin</span><span class="wx-meta-val" id="wxWind">--</span></div>
                <div class="wx-meta-item"><span class="wx-meta-label">Indeks UV</span><span class="wx-meta-val" id="wxUV">--</span></div>
                <div class="wx-meta-item"><span class="wx-meta-label">Presipitasi</span><span class="wx-meta-val" id="wxPrecip">--</span></div>
            </div>
        </div>

        {{-- 7-Day Forecast Strip --}}
        <div class="wx-7day fade-up" id="wx7Day">
            {{-- Populated by JS --}}
            @for($i = 0; $i < 7; $i++)
            <div class="wx-day-card wx-skeleton">
                <div class="wx-sk-bar" style="width:50%;height:12px;margin-bottom:8px;"></div>
                <div class="wx-sk-bar" style="width:40px;height:40px;border-radius:50%;margin:0 auto 8px;"></div>
                <div class="wx-sk-bar" style="width:70%;height:12px;margin-bottom:6px;"></div>
                <div class="wx-sk-bar" style="width:55%;height:10px;"></div>
            </div>
            @endfor
        </div>

        {{-- Footer / update time --}}
        <div class="wx-footer fade-up">
            <span id="wxUpdateTime">Memuat…</span>
            <span class="wx-footer-sep">•</span>
            <span>Sumber: <a href="https://open-meteo.com" target="_blank" rel="noopener">Open-Meteo</a></span>
            <button class="wx-refresh-btn" id="wxRefresh" title="Perbarui data">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M23 4v6h-6"/><path d="M1 20v-6h6"/>
                    <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/>
                </svg>
                Refresh
            </button>
        </div>

    </div>
</section>

{{-- ===== WEATHER STYLES ===== --}}
<style>
/* ---------- Section ---------- */
.weather-section {
    background: linear-gradient(160deg, #0d1e38 0%, #0a1628 60%, #0f2240 100%);
    position: relative;
    overflow: hidden;
}
.weather-section::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse 60% 40% at 80% 20%, rgba(37,99,235,0.18) 0%, transparent 60%),
        radial-gradient(ellipse 40% 60% at 10% 80%, rgba(240,165,0,0.10) 0%, transparent 55%);
    pointer-events: none;
}
.weather-section .section-header .eyebrow { color: var(--gold-lt); }
.weather-section .section-header h2,
.weather-section .section-header p { color: rgba(255,255,255,0.85); }
.weather-section .section-header p { color: rgba(255,255,255,0.45); }

/* ---------- Current Card ---------- */
.wx-current {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.09);
    backdrop-filter: blur(16px);
    border-radius: 24px;
    padding: 32px 36px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 32px;
    margin-bottom: 20px;
    flex-wrap: wrap;
    transition: border-color 0.3s;
}
.wx-current:hover { border-color: rgba(37,99,235,0.35); }

.wx-current-left {
    display: flex;
    align-items: center;
    gap: 24px;
}
.wx-current-icon {
    font-size: 64px;
    line-height: 1;
    filter: drop-shadow(0 4px 16px rgba(240,165,0,0.3));
    transition: transform 0.4s ease;
}
.wx-current-icon:hover { transform: scale(1.08) rotate(-4deg); }

.wx-current-temp {
    font-family: 'DM Serif Display', serif;
    font-size: 52px;
    color: var(--white);
    line-height: 1;
    letter-spacing: -1px;
}
.wx-current-temp sup {
    font-size: 22px;
    vertical-align: super;
    color: rgba(255,255,255,0.5);
}
.wx-current-desc {
    font-size: 15px;
    font-weight: 600;
    color: rgba(255,255,255,0.75);
    margin: 6px 0 4px;
}
.wx-current-loc {
    font-size: 12px;
    color: rgba(255,255,255,0.35);
    font-weight: 500;
    letter-spacing: 0.3px;
}

/* Right meta grid */
.wx-current-right {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px 28px;
}
.wx-meta-item {
    display: flex;
    flex-direction: column;
    gap: 3px;
}
.wx-meta-label {
    font-size: 10.5px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: rgba(255,255,255,0.3);
}
.wx-meta-val {
    font-size: 15px;
    font-weight: 700;
    color: var(--white);
}

/* ---------- 7-Day Strip ---------- */
.wx-7day {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 10px;
    margin-bottom: 16px;
}

.wx-day-card {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: 18px;
    padding: 18px 10px 16px;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;
    cursor: default;
    transition: background 0.25s, border-color 0.25s, transform 0.25s;
    position: relative;
    overflow: hidden;
}
.wx-day-card:hover {
    background: rgba(37,99,235,0.14);
    border-color: rgba(37,99,235,0.3);
    transform: translateY(-4px);
}
.wx-day-card.wx-today {
    background: rgba(37,99,235,0.16);
    border-color: rgba(37,99,235,0.45);
}
.wx-day-card.wx-today::before {
    content: 'Hari ini';
    position: absolute;
    top: 0; left: 50%;
    transform: translateX(-50%);
    background: var(--accent);
    color: var(--white);
    font-size: 9px;
    font-weight: 800;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    padding: 2px 10px;
    border-radius: 0 0 8px 8px;
}

.wx-day-name {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.8px;
    text-transform: uppercase;
    color: rgba(255,255,255,0.45);
    margin-top: 10px;
}
.wx-day-card.wx-today .wx-day-name { color: var(--gold-lt); }

.wx-day-date {
    font-size: 11px;
    color: rgba(255,255,255,0.25);
    font-weight: 500;
}

.wx-day-icon { font-size: 30px; line-height: 1; margin: 2px 0; }

.wx-day-high {
    font-size: 16px;
    font-weight: 800;
    color: var(--white);
}
.wx-day-low {
    font-size: 12px;
    color: rgba(255,255,255,0.35);
    font-weight: 600;
}

.wx-day-rain {
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 11px;
    color: #60a5fa;
    font-weight: 600;
    margin-top: 2px;
}
.wx-day-rain svg { opacity: 0.7; }

/* ---------- Skeleton ---------- */
.wx-skeleton { pointer-events: none; }
.wx-sk-bar {
    background: rgba(255,255,255,0.06);
    border-radius: 6px;
    animation: wxPulse 1.6s ease-in-out infinite;
    display: block;
}
@keyframes wxPulse {
    0%,100% { opacity: 0.5; }
    50%      { opacity: 1;   }
}

/* ---------- Footer ---------- */
.wx-footer {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 12px;
    color: rgba(255,255,255,0.25);
    flex-wrap: wrap;
}
.wx-footer a { color: rgba(255,255,255,0.35); text-decoration: none; }
.wx-footer a:hover { color: rgba(255,255,255,0.65); }
.wx-footer-sep { color: rgba(255,255,255,0.15); }

.wx-refresh-btn {
    margin-left: auto;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    font-weight: 700;
    color: rgba(255,255,255,0.35);
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 8px;
    padding: 6px 14px;
    cursor: pointer;
    transition: all 0.25s;
    font-family: 'Plus Jakarta Sans', sans-serif;
}
.wx-refresh-btn:hover {
    background: rgba(37,99,235,0.2);
    border-color: rgba(37,99,235,0.4);
    color: var(--white);
}
.wx-refresh-btn svg { transition: transform 0.5s; }
.wx-refresh-btn.spinning svg { animation: wxSpin 0.7s linear infinite; }
@keyframes wxSpin { to { transform: rotate(360deg); } }

/* ---------- Responsive ---------- */
@media (max-width: 900px) {
    .wx-7day { grid-template-columns: repeat(4, 1fr); }
    .wx-7day .wx-day-card:nth-child(n+5) { display: none; }
}
@media (max-width: 640px) {
    .wx-current { flex-direction: column; align-items: flex-start; padding: 24px 20px; }
    .wx-current-right { grid-template-columns: 1fr 1fr; width: 100%; }
    .wx-7day { grid-template-columns: repeat(3, 1fr); }
    .wx-7day .wx-day-card:nth-child(n+4) { display: none; }
    .wx-current-temp { font-size: 40px; }
}
@media (max-width: 380px) {
    .wx-current-left { flex-direction: column; align-items: flex-start; gap: 12px; }
}
</style>

{{-- ===== WEATHER SCRIPT ===== --}}
<script>
(function () {
    // ── Koordinat Gunungkidul ──────────────────────────────────────────────
    const LAT  = -7.9408;
    const LON  = 110.5993;
    const TZ   = 'Asia%2FJakarta';

    // ── WMO Weather Interpretation Code → { emoji, deskripsi } ──────────
    const WMO = {
        0:  { e: '☀️',  d: 'Cerah'              },
        1:  { e: '🌤️', d: 'Umumnya Cerah'       },
        2:  { e: '⛅',  d: 'Berawan Sebagian'    },
        3:  { e: '☁️',  d: 'Berawan'             },
        45: { e: '🌫️', d: 'Berkabut'            },
        48: { e: '🌫️', d: 'Kabut Beku'          },
        51: { e: '🌦️', d: 'Gerimis Ringan'      },
        53: { e: '🌦️', d: 'Gerimis Sedang'      },
        55: { e: '🌧️', d: 'Gerimis Lebat'       },
        61: { e: '🌧️', d: 'Hujan Ringan'        },
        63: { e: '🌧️', d: 'Hujan Sedang'        },
        65: { e: '🌧️', d: 'Hujan Lebat'         },
        71: { e: '🌨️', d: 'Salju Ringan'        },
        73: { e: '❄️',  d: 'Salju Sedang'       },
        75: { e: '❄️',  d: 'Salju Lebat'        },
        77: { e: '🌨️', d: 'Butiran Es'          },
        80: { e: '🌦️', d: 'Hujan Lokal Ringan'  },
        81: { e: '🌧️', d: 'Hujan Lokal Sedang'  },
        82: { e: '⛈️',  d: 'Hujan Lokal Lebat'  },
        85: { e: '🌨️', d: 'Hujan Salju Ringan'  },
        86: { e: '❄️',  d: 'Hujan Salju Lebat'  },
        95: { e: '⛈️',  d: 'Hujan Petir'        },
        96: { e: '⛈️',  d: 'Petir + Es Kecil'   },
        99: { e: '⛈️',  d: 'Petir + Es Besar'   },
    };

    function wmo(code) {
        return WMO[code] || { e: '🌡️', d: 'Tidak Diketahui' };
    }

    // ── Nama hari (Bahasa Indonesia) ──────────────────────────────────────
    const HARI = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    const BLAN = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];

    function formatDay(dateStr, isToday) {
        const d = new Date(dateStr + 'T00:00:00');
        return {
            dayName : isToday ? 'Hari Ini' : HARI[d.getDay()],
            dayDate : `${d.getDate()} ${BLAN[d.getMonth()]}`,
        };
    }

    // ── URL Open-Meteo ────────────────────────────────────────────────────
    const URL =
        `https://api.open-meteo.com/v1/forecast` +
        `?latitude=${LAT}&longitude=${LON}` +
        `&current=temperature_2m,relative_humidity_2m,apparent_temperature,` +
        `weather_code,wind_speed_10m,precipitation,uv_index` +
        `&daily=weather_code,temperature_2m_max,temperature_2m_min,precipitation_sum,precipitation_probability_max` +
        `&timezone=${TZ}&forecast_days=7`;

    // ── DOM refs ──────────────────────────────────────────────────────────
    const $icon   = document.getElementById('wxCurrentIcon');
    const $temp   = document.getElementById('wxCurrentTemp');
    const $desc   = document.getElementById('wxCurrentDesc');
    const $hum    = document.getElementById('wxHumidity');
    const $wind   = document.getElementById('wxWind');
    const $uv     = document.getElementById('wxUV');
    const $precip = document.getElementById('wxPrecip');
    const $7day   = document.getElementById('wx7Day');
    const $time   = document.getElementById('wxUpdateTime');
    const $btn    = document.getElementById('wxRefresh');

    // ── Fetch & render ────────────────────────────────────────────────────
    async function loadWeather() {
        $btn.classList.add('spinning');

        try {
            const res  = await fetch(URL);
            if (!res.ok) throw new Error('HTTP ' + res.status);
            const data = await res.json();

            const cur    = data.current;
            const daily  = data.daily;
            const todayISO = daily.time[0];

            // Current card
            const w = wmo(cur.weather_code);
            $icon.textContent   = w.e;
            $temp.textContent   = `${Math.round(cur.temperature_2m)}°C`;
            $desc.textContent   = w.d;
            $hum.textContent    = `${cur.relative_humidity_2m}%`;
            $wind.textContent   = `${Math.round(cur.wind_speed_10m)} km/h`;
            $uv.textContent     = uvLabel(cur.uv_index);
            $precip.textContent = `${cur.precipitation} mm`;

            // 7-day strip
            $7day.innerHTML = '';
            daily.time.forEach((dateStr, i) => {
                const isToday  = i === 0;
                const { dayName, dayDate } = formatDay(dateStr, isToday);
                const dw    = wmo(daily.weather_code[i]);
                const hi    = Math.round(daily.temperature_2m_max[i]);
                const lo    = Math.round(daily.temperature_2m_min[i]);
                const rain  = daily.precipitation_probability_max[i] ?? '--';
                const rainMM= daily.precipitation_sum[i] ?? 0;

                const card = document.createElement('div');
                card.className = 'wx-day-card' + (isToday ? ' wx-today' : '');
                card.innerHTML = `
                    <div class="wx-day-name">${dayName}</div>
                    <div class="wx-day-date">${dayDate}</div>
                    <div class="wx-day-icon">${dw.e}</div>
                    <div class="wx-day-high">${hi}°</div>
                    <div class="wx-day-low">${lo}°</div>
                    <div class="wx-day-rain">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none"
                             stroke="#60a5fa" stroke-width="2.5" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path d="M20 17.58A5 5 0 0 0 18 8h-1.26A8 8 0 1 0 4 16.25"/>
                            <line x1="8" y1="16" x2="8" y2="20"/>
                            <line x1="12" y1="14" x2="12" y2="18"/>
                            <line x1="16" y1="16" x2="16" y2="20"/>
                        </svg>
                        ${rain}%
                    </div>
                `;

                // Tooltip
                card.title = `${dw.d} · Curah hujan: ${rainMM} mm`;
                $7day.appendChild(card);
            });

            // Timestamp
            const now = new Date();
            $time.textContent =
                `Diperbarui: ${now.getHours().toString().padStart(2,'0')}:${now.getMinutes().toString().padStart(2,'0')} WIB`;

        } catch (err) {
            console.error('[Weather]', err);
            $desc.textContent = 'Gagal memuat data cuaca.';
            $icon.textContent = '⚠️';
            $temp.textContent = '--°C';
            $7day.innerHTML   =
                `<p style="color:rgba(255,255,255,.4);font-size:13px;grid-column:1/-1;text-align:center;padding:20px 0">
                    Gagal mengambil data. Periksa koneksi internet Anda.
                </p>`;
            $time.textContent = 'Pembaruan gagal';
        } finally {
            $btn.classList.remove('spinning');
        }
    }

    function uvLabel(v) {
        if (v == null) return '--';
        if (v <= 2)  return `${v} (Rendah)`;
        if (v <= 5)  return `${v} (Sedang)`;
        if (v <= 7)  return `${v} (Tinggi)`;
        if (v <= 10) return `${v} (Sangat Tinggi)`;
        return `${v} (Ekstrem)`;
    }

    // Refresh button
    $btn.addEventListener('click', loadWeather);

    // Auto-refresh setiap 15 menit
    loadWeather();
    setInterval(loadWeather, 15 * 60 * 1000);
})();
</script>