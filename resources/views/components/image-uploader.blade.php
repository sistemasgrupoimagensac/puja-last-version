{{-- <div x-data="imageUploader()">
  <form @submit.prevent="uploadImages()" enctype="multipart/form-data">
    @csrf --}}
{{-- 
<div>
  <div class="mb-3">
    <label for="images" class="form-label">Seleccionar imágenes</label>
    <input type="file" id="images" class="form-control" multiple @change="handleFileChange($event)">
  </div>

  <div class="mb-3">
    <div class="row" x-show="images.length > 0">
      <template x-for="(image, index) in images" :key="index">
        <div class="col-md-3 mb-3">
          <img :src="image.url" class="img-thumbnail" style="max-width: 100%;" :alt="'Imagen ' + (index + 1)">
        </div>
      </template>
    </div>
  </div>

</div> --}}
{{-- 

    <button type="submit" class="btn button-orange">Subir Imágenes</button>
  </form>
</div> --}}

<script>
  function imageUploader() {
    console.log('subir imagen');
    return {
      images: [],

      handleFileChange(event) {
        const files = event.target.files;
        for (let i = 0; i < files.length; i++) {
          const file = files[i];
          const reader = new FileReader();
          reader.onload = (e) => {
            this.images.push({
              url: e.target.result,
              file: file,
            });
          };
          reader.readAsDataURL(file);
        }
      },

      uploadImages() {
        const formData = new FormData();
        this.images.forEach((image) => {
          formData.append("images[]", image.file);
        });

        fetch("/upload-images", {
            method: "POST",
            body: formData,
          })
          .then((response) => {
            // Handle response
            console.log("Images uploaded successfully");
            // Clear images array or handle next steps
            this.images = [];
          })
          .catch((error) => {
            console.error("Error uploading images:", error);
          });
      },
    };
  }
</script>

@push('styles')
  @vite(['resources/sass/components/image_uploader.scss'])
@endpush
