{{--
  Partial: admin/partials/image-upload.blade.php
  Variabel yang diperlukan:
    $label      - Label
    $uploadName - name input file
    $urlName    - name input URL
    $currentUrl - URL gambar saat ini (nullable)
    $hint       - Teks hint (optional)
    $uid        - ID unik untuk elemen (misal: hero_bg, about_main)
--}}
@php $uid = $uid ?? uniqid(); @endphp

<div class="fg" style="margin-bottom:20px;">
  <label class="fl">{{ $label }}</label>

  {{-- Tab Switch --}}
  <div style="display:flex;border:1px solid #2a3040;border-radius:8px;overflow:hidden;width:fit-content;margin-bottom:12px;">
    <button type="button" id="tab-url-{{ $uid }}"
      onclick="switchTab('{{ $uid }}','url')"
      style="padding:7px 18px;border:none;font-size:12px;font-weight:600;cursor:pointer;font-family:inherit;transition:all .2s;background:{{ $currentUrl ? '#C0001C' : '#252c3d' }};color:{{ $currentUrl ? '#fff' : '#94a3b8' }};">
      🔗 URL
    </button>
    <button type="button" id="tab-file-{{ $uid }}"
      onclick="switchTab('{{ $uid }}','file')"
      style="padding:7px 18px;border:none;font-size:12px;font-weight:600;cursor:pointer;font-family:inherit;transition:all .2s;background:{{ $currentUrl ? '#252c3d' : '#C0001C' }};color:{{ $currentUrl ? '#94a3b8' : '#fff' }};">
      📁 Upload File
    </button>
  </div>

  {{-- Panel URL --}}
  <div id="panel-url-{{ $uid }}" style="display:{{ $currentUrl ? 'block' : 'none' }};">
    <input type="url" name="{{ $urlName }}" id="url-input-{{ $uid }}"
           class="fc" value="{{ $currentUrl ?? '' }}"
           placeholder="https://..."
           oninput="updatePreview('{{ $uid }}', this.value)"
           style="margin-bottom:10px;">
  </div>

  {{-- Panel Upload --}}
  <div id="panel-file-{{ $uid }}" style="display:{{ $currentUrl ? 'none' : 'block' }};">
    <div id="dropzone-{{ $uid }}"
         onclick="document.getElementById('file-{{ $uid }}').click()"
         ondragover="event.preventDefault();this.style.borderColor='#C0001C';this.style.background='rgba(192,0,28,.06)'"
         ondragleave="this.style.borderColor='#2a3040';this.style.background='#1a2030'"
         ondrop="handleDrop_{{ $uid }}(event)"
         style="border:2px dashed #2a3040;border-radius:8px;background:#1a2030;min-height:90px;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .2s;text-align:center;padding:16px;">
      <div id="dropzone-text-{{ $uid }}">
        <div style="font-size:28px;margin-bottom:6px;">🖼️</div>
        <div style="font-size:13px;color:#e2e8f0;font-weight:600;">Klik atau seret gambar ke sini</div>
        <div style="font-size:11px;color:#64748b;margin-top:3px;">JPG, PNG, WEBP · Maks. 4MB</div>
      </div>
    </div>
    <input type="file" id="file-{{ $uid }}" name="{{ $uploadName }}"
           accept="image/jpeg,image/png,image/webp"
           style="display:none;"
           onchange="handleFile_{{ $uid }}(this)">
  </div>

  {{-- Preview --}}
  <div id="preview-wrap-{{ $uid }}" style="margin-top:10px;{{ $currentUrl ? '' : 'display:none;' }}">
    <img id="preview-{{ $uid }}" src="{{ $currentUrl ?? '' }}"
         style="height:80px;width:auto;max-width:220px;object-fit:cover;border-radius:8px;border:1px solid #2a3040;display:block;"
         onerror="document.getElementById('preview-wrap-{{ $uid }}').style.display='none'">
    <div style="font-size:10px;color:#64748b;margin-top:4px;">Preview</div>
  </div>

  @if(!empty($hint))
  <div class="fhint">{{ $hint }}</div>
  @endif
</div>

<script>
function switchTab(uid, mode) {
  const urlPanel  = document.getElementById('panel-url-' + uid);
  const filePanel = document.getElementById('panel-file-' + uid);
  const tabUrl    = document.getElementById('tab-url-' + uid);
  const tabFile   = document.getElementById('tab-file-' + uid);

  if (mode === 'url') {
    urlPanel.style.display  = 'block';
    filePanel.style.display = 'none';
    tabUrl.style.background  = '#C0001C'; tabUrl.style.color  = '#fff';
    tabFile.style.background = '#252c3d'; tabFile.style.color = '#94a3b8';
  } else {
    urlPanel.style.display  = 'none';
    filePanel.style.display = 'block';
    tabUrl.style.background  = '#252c3d'; tabUrl.style.color  = '#94a3b8';
    tabFile.style.background = '#C0001C'; tabFile.style.color = '#fff';
  }
}

function updatePreview(uid, src) {
  const wrap = document.getElementById('preview-wrap-' + uid);
  const img  = document.getElementById('preview-' + uid);
  if (src) {
    wrap.style.display = 'block';
    img.src = src;
  } else {
    wrap.style.display = 'none';
  }
}

function processFile_{{ $uid }}(file) {
  if (!file) return;
  const allowed = ['image/jpeg','image/png','image/webp'];
  if (!allowed.includes(file.type)) {
    alert('Format tidak didukung. Gunakan JPG, PNG, atau WEBP.');
    return;
  }
  if (file.size > 4 * 1024 * 1024) {
    alert('Ukuran file terlalu besar. Maksimal 4MB.');
    return;
  }

  // Tampilkan nama file di dropzone
  const dz = document.getElementById('dropzone-text-{{ $uid }}');
  const kb  = (file.size / 1024).toFixed(0);
  dz.innerHTML = '<div style="font-size:22px;margin-bottom:4px;">✅</div>'
               + '<div style="font-size:13px;color:#4ade80;font-weight:600;">' + file.name + '</div>'
               + '<div style="font-size:11px;color:#64748b;margin-top:2px;">' + kb + ' KB — Siap diupload</div>';

  // Preview lokal
  const reader = new FileReader();
  reader.onload = function(e) {
    updatePreview('{{ $uid }}', e.target.result);
  };
  reader.readAsDataURL(file);
}

function handleFile_{{ $uid }}(input) {
  if (input.files && input.files[0]) {
    processFile_{{ $uid }}(input.files[0]);
  }
}

function handleDrop_{{ $uid }}(event) {
  event.preventDefault();
  const dz = document.getElementById('dropzone-{{ $uid }}');
  dz.style.borderColor = '#2a3040';
  dz.style.background  = '#1a2030';

  const file = event.dataTransfer.files[0];
  if (!file) return;

  // Assign ke input file
  const input = document.getElementById('file-{{ $uid }}');
  try {
    const dt = new DataTransfer();
    dt.items.add(file);
    input.files = dt.files;
  } catch(e) { /* Safari fallback */ }

  processFile_{{ $uid }}(file);
}
</script>
