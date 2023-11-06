  {{-- Modal Ajukan presentasi --}}

  <div class="modal fade" id="ajukanPresentasi" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Ajukan Presentasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('ta') }}" method="post" id="formAjukanPresentasi">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="judul" class="form-label">Judul Presentasi</label>
                        <input type="text" id="judul" name="judul" class="form-control"
                            placeholder="Masukan Judul Presentasi">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="deskripsi" class="form-label">Deskripsi Presentasi</label>
                        <textarea name="deskripsi" id="deskripsi" cols="20" rows="10" class="form-control" style="resize: none"
                            placeholder="Isi deskripsi pengajuan anda"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="jadwal" class="form-label">Atur Jadwal</label>
                        <input type="date" name="jadwal" id="jadwal"
                            class="form-control datepicker-days">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary waves-effect"
                    data-bs-dismiss="modal">Kembali</button>
                <button type="button" class="btn btn-primary waves-effect waves-light">Ajukan</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- Akhir modal ajukan presentasi

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>

    const FormPresentasi = document.getElementById('formAjukanPresentasi')

     FormPresentasi.addEventListener('submit',(event)=>{
        event.preventDefault();
        const judul = document.getElementById('judul').value
        const deskripsi = document.getElementById('deskripsi').value
        const jadwal = document.getElementById('jadwal').value
        const tim_id = "{{ $tim->uuid }}"
        axios.post('/tambah-presentasi',{judul,deskripsi,jadwal,tim_id})
        .then((res) => {
            const newData =
        })
    })

</script> --}}
