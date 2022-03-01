<!-- Bahan Baku Modal-->
<div class="modal fade modal-child" id="addBahanModal" tabindex="-1" role="dialog" data-backdrop="static"
data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true" data-modal-parent="#addMarkerModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Jenis Bahan Baku</h5>
            </div>
            <form id="addBahanForm">
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" width="3%">
                                    <div class="custom-control custom-checkbox" style="display: inline-block;">
                                        <input type="checkbox" id="checkAllBahan" class="custom-control-input">
                                        <label class="custom-control-label" for="checkAllBahan"></label>
                                    </div>
                                </th>
                                <th scope="col">Jenis Bahan</th>
                                <th scope="col">Kapasitas/Bulan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jenis_bahan as $row)
                            <tr>
                                <th scope="row">
                                    <div class="custom-control custom-checkbox" style="display: inline-block;">
                                        <input type="checkbox" value="{{ $row->JENIS_BAHAN }}"
                                            data-id="{{ $row->ID_JENIS_BAHAN }} " name="c_bahan_baku[]" required
                                            id="c_bahan_baku{{ $row->ID_JENIS_BAHAN }}"
                                            class="custom-control-input c-bahan-baku">
                                        <label class="custom-control-label"
                                            for="c_bahan_baku{{ $row->ID_JENIS_BAHAN }}"></label>
                                    </div>
                                </th>
                                <td>{{ $row->JENIS_BAHAN }}</td>
                                <td><input type="tel" placeholder="Kapasitas (KG)" data-value="{{ $row->JENIS_BAHAN }}"
                                        name="c_bahan_baku_kg[]" id="c_bahan_baku_kg{{ $row->ID_JENIS_BAHAN }}"
                                        autocomplete="off" class="form-control numeric c-bahan-baku-kg" readonly></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" id="okBahanBaku" href="#">OK</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade modal-child" id="addPenjualanModal" tabindex="-1" role="dialog" data-backdrop="static"
data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true" data-modal-parent="#addMarkerModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Penjualan Bahan Baku</h5>
            </div>
            <form id="addPenjualanForm">
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" width="3%">
                                        <div class="custom-control custom-checkbox" style="display: inline-block;">
                                            <input type="checkbox" id="checkAllPenjualan" class="custom-control-input">
                                            <label class="custom-control-label" for="checkAllPenjualan"></label>
                                        </div>
                                    </th>
                                    <th scope="col">Penjualan Bahan Baku</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Proses Penjualan</th>
                                    <th scope="col" width="15%">Proses Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tempat_penjualan as $row)
                                <tr>
                                    <th scope="row">
                                        <div class="custom-control custom-checkbox" style="display: inline-block;">
                                            <input type="checkbox" value="{{ $row->TEMPAT_PENJUALAN }}"
                                                data-id="{{ $row->ID_TEMPAT_PENJUALAN }} " name="c_penjualan_bahan[]"
                                                required id="c_penjualan_bahan{{ $row->ID_TEMPAT_PENJUALAN }}"
                                                class="custom-control-input c-penjualan-bahan">
                                            <label class="custom-control-label"
                                                for="c_penjualan_bahan{{ $row->ID_TEMPAT_PENJUALAN }}"></label>
                                        </div>
                                    </th>
                                    <td style="text-transform: capitalize;">{{ $row->TEMPAT_PENJUALAN }}</td>
                                    <td><input type="text" placeholder="Keterangan"
                                            data-value="{{ $row->TEMPAT_PENJUALAN }}" name="c_penjualan_bahan_ket[]"
                                            id="c_penjualan_bahan_ket{{ $row->ID_TEMPAT_PENJUALAN }}" autocomplete="off"
                                            class="form-control c-penjualan-bahan-ket" readonly></td>
                                    <td>
                                        <select class="form-control c-proses-penjualan select_2" required
                                            data-placeholder="Proses Penjualan" name="c_proses_penjualan[]"
                                            data-value="{{ $row->TEMPAT_PENJUALAN }}" disabled
                                            id="c_proses_penjualan{{ $row->ID_TEMPAT_PENJUALAN }}">
                                            <option value=""></option>
                                            <option value="dikirim">Dikirim</option>
                                            <option value="diambil">Diambil</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control c-proses-pembayaran select_2"
                                            data-placeholder="Pilih Proses Pembayaran"
                                            data-value="{{ $row->TEMPAT_PENJUALAN }}" name="c_proses_pembayaran[]"
                                            required id="c_proses_pembayaran{{ $row->ID_TEMPAT_PENJUALAN }}" disabled>
                                            <option value=""></option>
                                            @foreach ($jenis_pembayaran as $row)
                                            <option value="{{ strtolower($row->JENIS_PEMBAYARAN) }}">
                                                {{ $row->JENIS_PEMBAYARAN }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" id="okPenjualanBahan" href="#">OK</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade modal-child" id="addMesinModal" tabindex="-1" role="dialog" data-backdrop="static"
data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true" data-modal-parent="#addMarkerModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Mesin</h5>
            </div>
            <form id="addMesinForm">
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" width="3%">
                                        <div class="custom-control custom-checkbox" style="display: inline-block;">
                                            <input type="checkbox" id="checkAllMesin" class="custom-control-input">
                                            <label class="custom-control-label" for="checkAllMesin"></label>
                                        </div>
                                    </th>
                                    <th scope="col" width="40%">Mesin</th>
                                    <th scope="col" width="40%">Kepemilikan</th>
                                    <th scope="col">Kuantitas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mesin as $row)
                                <tr>
                                    <th scope="row">
                                        <div class="custom-control custom-checkbox" style="display: inline-block;">
                                            <input type="checkbox" value="{{ $row->MESIN }}"
                                                data-id="{{ $row->ID_MESIN }} " name="c_mesin[]" required
                                                id="c_mesin{{ $row->ID_MESIN }}" class="custom-control-input c-mesin">
                                            <label class="custom-control-label"
                                                for="c_mesin{{ $row->ID_MESIN }}"></label>
                                        </div>
                                    </th>
                                    <td style="text-transform: capitalize;">{{ $row->MESIN }}</td>
                                    <td>
                                        <select class="form-control c-kepemilikan select_2" required
                                            data-placeholder="Kepemilikan" name="c_kepemilikan[]"
                                            data-value="{{ $row->MESIN }}" disabled
                                            id="c_kepemilikan{{ $row->ID_MESIN }}">
                                            <option value=""></option>
                                            <option value="milik sendiri">Milik Sendiri</option>
                                            <option value="dipinjamkan">Dipinjamkan</option>
                                        </select>
                                    </td>
                                    <td><input type="tel" placeholder="Kuantitas" name="c_mesin_qty[]"
                                            id="c_mesin_qty{{ $row->ID_MESIN }}" autocomplete="off"
                                            data-value="{{ $row->MESIN }}" class="form-control c-mesin-qty numeric"
                                            readonly></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" id="okMesin" href="#">OK</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade modal-child" id="addJarakModal" tabindex="-1" role="dialog" data-backdrop="static"
data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true" data-modal-parent="#addMarkerModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Jarak</h5>
            </div>
            <form id="addJarakForm">
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" width="3%">
                                        <div class="custom-control custom-checkbox" style="display: inline-block;">
                                            <input type="checkbox" id="checkAllPlant" class="custom-control-input">
                                            <label class="custom-control-label" for="checkAllPlant"></label>
                                        </div>
                                    </th>
                                    <th scope="col" width="67%">Plant</th>
                                    <th scope="col" width="30%">Jarak (Meter)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($plant as $row)
                                <tr>
                                    <th scope="row">
                                        <div class="custom-control custom-checkbox" style="display: inline-block;">
                                            <input type="checkbox" value="{{ $row->KODE }}"
                                                data-id="{{ $row->KODE }}" name="c_plant[]" required
                                                id="c_plant{{ $row->KODE }}" class="custom-control-input c-plant">
                                            <label class="custom-control-label"
                                                for="c_plant{{ $row->KODE }}"></label>
                                        </div>
                                    </th>
                                    <td style="text-transform: capitalize;">{{ $row->NAMA }}</td>
                                    <td><input type="tel" placeholder="Jarak" name="c_plant_jarak[]"
                                            id="c_plant_jarak{{ $row->KODE }}" autocomplete="off"
                                            data-value="{{ $row->KODE }}" class="form-control c-plant-jarak numeric"
                                            readonly></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" id="okJarak" href="#">OK</a>
                </div>
            </form>
        </div>
    </div>
</div>