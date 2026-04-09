@extends('layouts.front')

@section('content')
<div class="pg">
    <div class="wrap">

        {{-- TOPBAR --}}
        <div class="topbar">
            <a href="{{ url('/') }}" class="btn-home">
                <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                <span>Kembali ke beranda</span>
            </a>
            <form action="{{ route('logout') }}" method="POST" style="margin:0">
                @csrf
                <button type="submit" class="btn-logout">
                    <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    <span>Keluar</span>
                </button>
            </form>
        </div>

        {{-- CARD UTAMA --}}
        <div class="card">

            {{-- HEADER --}}
            <div class="hdr">
                <div class="hdr-name">{{ auth()->user()->name }}</div>
                <div class="hdr-email">{{ auth()->user()->email }}</div>
                <span class="pill">Alumni</span>
            </div>

            <div class="body">

                {{-- ALERT SUKSES --}}
                @if(session('success'))
                    <div class="alert-ok" style="display:flex">
                        <div class="ok-dot"></div>
                        {{ session('success') }}
                    </div>
                @endif

                {{-- ALERT ERROR --}}
                @if($errors->any())
                    <div class="alert-err" style="display:flex;flex-direction:column;gap:4px">
                        @foreach($errors->all() as $error)
                            <div style="display:flex;align-items:center;gap:8px">
                                <div class="err-dot"></div>
                                {{ $error }}
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- INFORMASI AKUN --}}
                <div class="sec">
                    <span class="sec-lbl">Informasi akun</span>
                    <div class="sec-line"></div>
                </div>

                <div class="info-row">
                    <div class="ibox">
                        <div class="ibox-lbl">Nama lengkap</div>
                        <div class="ibox-val">{{ auth()->user()->name }}</div>
                    </div>
                    <div class="ibox">
                        <div class="ibox-lbl">Email</div>
                        <div class="ibox-val" style="font-size:13px">{{ auth()->user()->email }}</div>
                    </div>
                    <div class="ibox" style="grid-column:1/-1">
                        <div class="ibox-lbl">Password</div>
                        <div class="ibox-val dots">••••••••••</div>
                    </div>
                </div>

                <div class="divider"></div>

                {{-- UBAH PASSWORD --}}
                <div class="sec">
                    <span class="sec-lbl">Ubah password</span>
                    <div class="sec-line"></div>
                </div>

                <form action="{{ route('alumni.update-password') }}" method="POST">
                    @csrf

                    <div class="frow">
                        <div class="field">
                            <label>Password baru</label>
                            <input type="password"
                                   name="password"
                                   id="pw"
                                   placeholder="Min. 8 karakter"
                                   minlength="8"
                                   required
                                   oninput="upd(this.value)">
                            <div class="bars">
                                <div class="bar" id="b1"></div>
                                <div class="bar" id="b2"></div>
                                <div class="bar" id="b3"></div>
                                <div class="bar" id="b4"></div>
                            </div>
                        </div>
                        <div class="field">
                            <label>Konfirmasi password</label>
                            <input type="password"
                                   name="password_confirmation"
                                   id="pw2"
                                   placeholder="Ulangi password"
                                   required>
                        </div>
                    </div>

                    <div class="tip">
                        <div class="tip-dot"></div>
                        Gunakan minimal 8 karakter, kombinasi huruf besar, angka, dan simbol
                    </div>

                    <div class="actions">
                        <a href="{{ route('welcome') }}" class="btn-cancel">Batal</a>
                        <button type="submit" class="btn-save">Simpan password</button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

<style>
*{box-sizing:border-box;margin:0;padding:0}

.pg {
    background: #f0f6ff;
    min-height: 100vh;
    padding: 2.5rem 1rem;
    display: flex;
    justify-content: center;
}

.wrap {
    width: 100%;
    max-width: 660px;
}

/* ── TOPBAR ── */
.topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.2rem;
    padding: 0 2px;
}

.btn-home {
    display: flex;
    align-items: center;
    gap: 7px;
    background: #fff;
    border: 0.5px solid #cfe2ff;
    border-radius: 12px;
    padding: 9px 16px;
    font-size: 13px;
    font-weight: 500;
    color: #2563eb;
    cursor: pointer;
    text-decoration: none;
    transition: all .15s;
}
.btn-home:hover { background: #e8f1ff; }
.btn-home svg {
    width: 15px;
    height: 15px;
    stroke: #2563eb;
    fill: none;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.btn-logout {
    display: flex;
    align-items: center;
    gap: 7px;
    background: #fff;
    border: 0.5px solid #fecaca;
    border-radius: 12px;
    padding: 9px 16px;
    font-size: 13px;
    font-weight: 500;
    color: #dc2626;
    cursor: pointer;
    transition: all .15s;
}
.btn-logout:hover { background: #fff5f5; }
.btn-logout svg {
    width: 15px;
    height: 15px;
    stroke: #dc2626;
    fill: none;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
}

/* ── CARD ── */
.card {
    background: #fff;
    border-radius: 24px;
    border: 0.5px solid #cfe2ff;
    overflow: hidden;
}

/* ── HEADER ── */
.hdr {
    background: #e8f1ff;
    padding: 2rem 2rem 1.6rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;
    border-bottom: 0.5px solid #cfe2ff;
}
.hdr-name {
    font-size: 18px;
    font-weight: 500;
    color: #0c3586;
}
.hdr-email {
    font-size: 13px;
    color: #6b97d4;
}
.pill {
    background: #d4e6ff;
    color: #0c3586;
    font-size: 11px;
    font-weight: 500;
    padding: 3px 14px;
    border-radius: 20px;
    margin-top: 4px;
}

/* ── BODY ── */
.body { padding: 2rem; }

/* ── ALERTS ── */
.alert-ok {
    background: #e8f4ff;
    border: 0.5px solid #90c4f8;
    border-radius: 12px;
    padding: 11px 16px;
    font-size: 13px;
    color: #0c3586;
    margin-bottom: 1.5rem;
    align-items: center;
    gap: 8px;
}
.ok-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #3b82f6;
    flex-shrink: 0;
}

.alert-err {
    background: #fff5f5;
    border: 0.5px solid #fecaca;
    border-radius: 12px;
    padding: 11px 16px;
    font-size: 13px;
    color: #dc2626;
    margin-bottom: 1.5rem;
}
.err-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #dc2626;
    flex-shrink: 0;
}

/* ── SECTION LABEL ── */
.sec {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 1rem;
}
.sec-line {
    flex: 1;
    height: 0.5px;
    background: #daeaff;
}
.sec-lbl {
    font-size: 11px;
    font-weight: 500;
    color: #6b97d4;
    text-transform: uppercase;
    letter-spacing: .7px;
    white-space: nowrap;
}

/* ── INFO BOXES ── */
.info-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    margin-bottom: 1.6rem;
}
.ibox {
    background: #f0f6ff;
    border-radius: 12px;
    border: 0.5px solid #cfe2ff;
    padding: 14px 16px;
}
.ibox-lbl {
    font-size: 11px;
    color: #6b97d4;
    font-weight: 500;
    margin-bottom: 5px;
}
.ibox-val {
    font-size: 14px;
    font-weight: 500;
    color: #0c3586;
}
.ibox-val.dots {
    letter-spacing: 3px;
    color: #90c4f8;
    font-size: 16px;
}

.divider {
    height: 0.5px;
    background: #daeaff;
    margin: 1.6rem 0;
}

/* ── FORM ── */
.frow {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    margin-bottom: 12px;
}
.field {
    display: flex;
    flex-direction: column;
    gap: 6px;
}
.field label {
    font-size: 12px;
    color: #6b97d4;
    font-weight: 500;
}
.field input {
    border: 0.5px solid #cfe2ff;
    border-radius: 12px;
    padding: 11px 15px;
    font-size: 14px;
    background: #f8fbff;
    color: #0c3586;
    outline: none;
    transition: all .2s;
}
.field input:focus {
    border-color: #3b82f6;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(59,130,246,.12);
}
.field input::placeholder { color: #b8d3f4; }

/* ── STRENGTH BARS ── */
.bars {
    display: flex;
    gap: 4px;
    margin-top: 6px;
}
.bar {
    height: 3px;
    flex: 1;
    border-radius: 2px;
    background: #daeaff;
    transition: background .3s;
}

/* ── TIP ── */
.tip {
    background: #e8f1ff;
    border-radius: 12px;
    border: 0.5px solid #cfe2ff;
    padding: 11px 15px;
    font-size: 12px;
    color: #6b97d4;
    margin-bottom: 1.6rem;
    display: flex;
    align-items: center;
    gap: 8px;
}
.tip-dot {
    width: 5px;
    height: 5px;
    border-radius: 50%;
    background: #6b97d4;
    flex-shrink: 0;
}

/* ── ACTION BUTTONS ── */
.actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}
.btn-cancel {
    padding: 10px 20px;
    border-radius: 12px;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    border: 0.5px solid #cfe2ff;
    background: #fff;
    color: #6b97d4;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: all .15s;
}
.btn-cancel:hover { background: #f0f6ff; }
.btn-save {
    padding: 10px 22px;
    border-radius: 12px;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    border: 0.5px solid #2563eb;
    background: #2563eb;
    color: #fff;
    transition: all .15s;
}
.btn-save:hover { background: #1d4ed8; }
.btn-save:active { transform: scale(.98); }

/* ── RESPONSIVE ── */
@media (max-width: 480px) {
    .info-row, .frow { grid-template-columns: 1fr; }
    .pg { padding: 1.5rem .75rem; }
    .btn-home span, .btn-logout span { display: none; }
}
</style>

<script>
function upd(v) {
    const colors = ['#ef4444', '#f97316', '#eab308', '#22c55e'];
    let score = 0;
    if (v.length >= 8) score++;
    if (/[A-Z]/.test(v)) score++;
    if (/[0-9]/.test(v)) score++;
    if (/[^A-Za-z0-9]/.test(v)) score++;
    ['b1', 'b2', 'b3', 'b4'].forEach((id, i) => {
        document.getElementById(id).style.background = i < score ? colors[score - 1] : '#daeaff';
    });
}
</script>

@endsection