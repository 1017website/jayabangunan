{{--
  Komponen: Image Upload + URL Input
  Props:
    $label      - Label yang ditampilkan
    $uploadName - Name untuk input file (misal: upload_hero_bg_image)
    $urlName    - Name untuk input[settings] URL (misal: settings[hero_bg_image])
    $currentUrl - URL gambar saat ini (dari DB)
    $hint       - Teks hint kecil di bawah (opsional)
--}}
@props(['label','uploadName','urlName','currentUrl'=>null,'hint'=>null])

<div class="fg img-upload-group" x-data="imgUpload('{{ $currentUrl }}')" style="margin-bottom:24px;">
  <label class="fl">{{ $label }}</label>

  {{-- Tab switcher --}}
  <div style="display:flex;gap:0;margin-bottom:12px;border:1px solid #2a3040;border-radius:8px;overflow:hidden;width:fit-content;">
    <button type="button"
            @click="mode='url'"
            :style="mode==='url' ? 'background:#C0001C;color:#fff;' : 'background:#252c3d;color:#64748b;'"
            style="padding:7px 16px;border:none;font-size:12px;font-weight:600;cursor:pointer;transition:all .2s;font-family:inherit;">
      🔗 URL
    </button>
    <button type="button"
            @click="mode='file'"
            :style="mode==='file' ? 'background:#C0001C;color:#fff;' : 'background:#252c3d;color:#64748b;'"
            style="padding:7px 16px;border:none;font-size:12px;font-weight:600;cursor:pointer;transition:all .2s;font-family:inherit;">
      📁 Upload File
    </button>
  </div>

  {{-- URL input --}}
  <div x-show="mode==='url'" x-transition>
    <input type="url"
           name="{{ $urlName }}"
           class="fc"
           :value="currentUrl"
           @input="currentUrl=$event.target.value;preview=currentUrl"
           placeholder="https://..."
           style="margin-bottom:10px;">
  </div>

  {{-- File upload input --}}
  <div x-show="mode==='file'" x-transition>
    <div class="upload-dropzone"
         @dragover.prevent="dragging=true"
         @dragleave.prevent="dragging=false"
         @drop.prevent="handleDrop($event)"
         :class="dragging ? 'drag-over' : ''"
         onclick="document.getElementById('{{ $uploadName }}').click()"
         style="cursor:pointer;">
      <input type="file"
             id="{{ $uploadName }}"
             name="{{ $uploadName }}"
             accept="image/jpeg,image/png,image/webp"
             style="display:none;"
             @change="handleFile($event)">
      <template x-if="!fileSelected">
        <div style="text-align:center;padding:28px 20px;">
          <div style="font-size:32px;margin-bottom:8px;">🖼️</div>
          <div style="font-size:13px;color:#e2e8f0;font-weight:600;">Klik atau seret gambar ke sini</div>
          <div style="font-size:11px;color:#64748b;margin-top:4px;">JPG, PNG, WEBP · Maks. 4MB</div>
        </div>
      </template>
      <template x-if="fileSelected">
        <div style="text-align:center;padding:12px;">
          <div style="font-size:11px;color:#4ade80;margin-bottom:6px;">✅ File dipilih:</div>
          <div x-text="fileName" style="font-size:12px;color:#e2e8f0;word-break:break-all;"></div>
          <div x-text="fileSize" style="font-size:11px;color:#64748b;margin-top:2px;"></div>
        </div>
      </template>
    </div>
  </div>

  {{-- Preview gambar saat ini --}}
  <div x-show="preview" x-transition style="margin-top:10px;position:relative;display:inline-block;">
    <img :src="preview" alt="Preview"
         style="height:80px;width:auto;max-width:200px;object-fit:cover;border-radius:8px;border:1px solid #2a3040;display:block;"
         @error="preview=null">
    <div style="font-size:10px;color:#64748b;margin-top:4px;">Preview gambar saat ini</div>
  </div>

  @if($hint)
  <div class="fhint">{{ $hint }}</div>
  @endif
</div>

<style>
.upload-dropzone{
  border:2px dashed #2a3040;border-radius:8px;
  background:#1a2030;transition:all .2s;
  min-height:80px;display:flex;align-items:center;justify-content:center;
}
.upload-dropzone:hover,.upload-dropzone.drag-over{
  border-color:#C0001C;background:rgba(192,0,28,.06);
}
</style>

<script>
function imgUpload(currentUrl) {
  return {
    mode: currentUrl ? 'url' : 'file',
    currentUrl: currentUrl || '',
    preview: currentUrl || null,
    fileSelected: false,
    fileName: '',
    fileSize: '',
    dragging: false,

    handleFile(event) {
      const file = event.target.files[0];
      if (!file) return;
      this.processFile(file);
    },

    handleDrop(event) {
      this.dragging = false;
      const file = event.dataTransfer.files[0];
      if (!file) return;
      // Set ke input file
      const input = document.getElementById('{{ $uploadName }}');
      const dt = new DataTransfer();
      dt.items.add(file);
      input.files = dt.files;
      this.processFile(file);
    },

    processFile(file) {
      if (!file.type.startsWith('image/')) {
        alert('Hanya file gambar yang diizinkan (JPG, PNG, WEBP)');
        return;
      }
      if (file.size > 4 * 1024 * 1024) {
        alert('Ukuran file maksimal 4MB');
        return;
      }
      this.fileSelected = true;
      this.fileName = file.name;
      this.fileSize = (file.size / 1024).toFixed(0) + ' KB';

      // Preview lokal
      const reader = new FileReader();
      reader.onload = (e) => { this.preview = e.target.result; };
      reader.readAsDataURL(file);
    }
  }
}
</script>
