{{-- <div class="flex flex-col p-10">
    A good traveler has no fixed plans and is not intent upon arriving.

    <p>
        {{$serviceData->status_dps->status_type}}
    </p>
    <p>
        {{$serviceData->alamatServis_dps->nama_alamat}}
    </p>
    <p>
        {{$serviceData->produk_dps->nama_produk}}
    </p>
    <p>
        {{$serviceData->produk_dps->serial_number}}
    </p>
    <p>
        {{$serviceData->tipeService_dps->nama_tipe_service}}
    </p>
    <p>
        {{$serviceData->permasalahan}}
    </p>

    <p>
        {{$serviceData->nomor_service}}
    </p>
    <p>
        {{$serviceData->pelanggan_dps->nama}}
    </p>
    <p>
        {{$serviceData->waktu_mulai}}
    </p>

    <p>
        {{$serviceData->teknisi_dps->username}}
    </p>
    <p>
        {{$serviceData->jadwal_kunjungan}}
    </p>
</div> --}}

<div class="flex flex-col p-10 pt-0 gap-10">
    <form wire:submit.prevent="editTiketDpsData()" class="flex flex-row gap-5">
        <div class="flex flex-col w-[80%] bg-white shadow-md rounded-lg">
            <div class="flex px-5 py-3 justify-between border-b-1 border-blue-100">
                <p class="text-xl font-medium">Informasi Servis</p>
                @if ($serviceData->id_teknisi == session(key:'user_id') )
                    <div class="flex flex-row gap-5">
                        @if ($serviceData->status == 4)
                            <a href="{{ route('export-servis-dps', ['id' => $serviceData->id]) }}" 
                                target="_blank" rel="noopener noreferrer"
                                class="bg-gray-100 border border-blue-200 max-w-fit max-h-fit text-blue-400  font-medium px-2 py-1 rounded-lg hover:bg-blue-200">
                                + PDF LAPORAN
                            </a> 
                        @else
                            <button x-data = "{ show: false }"
                                    x-on:open-edit-techlog.window="show = !show"
                                    x-on:click="$dispatch('open-edit-techlog')"
                                    type="button"
                                    class="bg-[#0f387a] border border-[#132c53] max-w-fit max-h-fit text-white font-medium px-2 py-1 rounded-lg hover:bg-[#0b4095] cursor-pointer"
                                    :class="{ 'bg-red-500/80 hover:bg-red-500/80 hover:opacity-60 border-red-500/80 ': show }"
                                    x-text="show ? 'Cancel' : 'Edit Data'">
                            </button> 
                            <button x-data = "{ show: false }"
                                    x-on:open-edit-techlog.window="show = !show"
                                    type="submit"
                                    class="hidden bg-[#0f387a] border border-[#132c53] max-w-fit max-h-fit text-white font-medium px-2 py-1 rounded-lg hover:bg-[#0b4095] cursor-pointer"
                                    :class="{ 'inline': show }">
                                Confirm
                            </button> 
                        @endif
                    </div>
                @else
                    @if ($serviceData->status == 4)
                        <a href="{{ route('export-servis-dps', ['id' => $serviceData->id]) }}" 
                            target="_blank" rel="noopener noreferrer"
                            class="bg-gray-100 border border-blue-200 max-w-fit max-h-fit text-blue-400  font-medium px-2 py-1 rounded-lg hover:bg-blue-200">
                        + PDF LAPORAN
                        </a> 
                    @endif
                @endif
            </div>
            <div x-data = "{ show: false }"
                x-on:open-edit-techlog.window="show = !show"
                class="flex flex-col pl-32 pr-8 py-5 gap-5 [&_p]:font-semibold"
                :class="{'hidden w-full': show}"
                >
                <div class="flex flex-row gap-5">
                    <h2 class="font-medium min-w-[125px]">Status</h2>
                    <p class="">
                        @php
                            $statusType = $serviceData->status ? $serviceData->status_dps->id : 'N/A';
                            $color_map_status = [
                                '1' => 'bg-gray-500',
                                '2' => 'bg-green-700',
                                '3' => 'bg-orange-700/80',
                                '4' => 'bg-[#5993FF]',
                            ];
                            $statusClass = $color_map_status[$statusType] ?? 'bg-gray-500';
                        @endphp
                        <span class="{{ $statusClass }} text-white p-1 pl-2 pr-2 rounded-4xl">
                            {{$serviceData->status_dps->status_type}}
                        </span>
                    </p>
                </div>
                <div class="flex flex-row gap-5">
                    <h2 class="font-medium min-w-[125px]">Alamat Servis</h2>
                    <p class="">{{ $serviceData->produk_dps?->alamatServis_dps?->nama_alamat }}</p>
                </div>
                <div class="flex flex-row gap-5">
                    <h2 class="font-medium min-w-[125px]">Nama Produk</h2>
                    <p class="">{{$serviceData->produk_dps->nama_produk}}</p>
                </div>
                <div class="flex flex-row gap-5">
                    <h2 class="font-medium min-w-[125px]">Nomor Seri (SN)</h2>
                    <p class="">{{$serviceData->produk_dps->serial_number}}</p>
                </div>
                <div class="flex flex-row gap-5">
                    <h2 class="font-medium min-w-[125px]">Tipe</h2>
                    <p class="">{{$serviceData->tipeService_dps->nama_tipe_service}}</p>
                </div>
                <div class="flex flex-row gap-5">
                    <h2 class="font-medium min-w-[125px]">Keluhan</h2>
                    <p class="">{{$serviceData->permasalahan}}</p>
                </div>
            </div>
            <div x-data = "{ show: false }"
                x-on:open-edit-techlog.window="show = !show"
                class="hidden w-full flex-col pl-32 pr-8 py-5 gap-5 [&_p]:font-semibold"
                :class="{'inline-flex': show}"
                >
                <div class="flex flex-row gap-5">
                    <h2 class="font-medium min-w-[125px]">Status</h2>
                    <p class="">{{$serviceData->status_dps->status_type}}</p>
                </div>
                <div class="flex flex-row gap-5">
                    <label class="font-medium min-w-[125px]">Alamat Servis</label>
                    <div class="flex flex-col w-full">
                        <select class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('edit_alamat_servis') border-red-500 @enderror"
                                wire:model.fill="edit_alamat_servis">
                            <option value="" selected>-- Hiraukan jika tidak diubah --</option>
                            @foreach($alamat_servis_list as $w)
                                <option value="{{$w->id}}">{{$w->nama_alamat}}</option>
                            @endforeach
                        </select>
                        @error('edit_alamat_servis')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-row gap-5">
                    <label class="font-medium min-w-[125px]">Nama Produk</label>
                    <div class="flex flex-col w-full">
                        <input id="input-sku" 
                            wire:model.fill="edit_nama_produk"
                            class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2 @error('edit_nama_produk') border-red-500 @enderror" 
                            value="{{$serviceData->produk_dps->nama_produk}}">
                        </input>
                        @error('edit_nama_produk')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-row gap-5">
                    <label class="font-medium min-w-[125px]">Nomor Seri (SN)</label>
                    <div class="flex flex-col w-full">
                        <input id="input-sku" 
                            wire:model.fill="edit_sn_produk"
                            class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2 @error('edit_sn_produk') border-red-500 @enderror" 
                            value="{{$serviceData->produk_dps->serial_number}}">
                        </input>
                        @error('edit_sn_produk')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-row gap-5">
                    <label class="font-medium min-w-[125px]">Tipe</label>
                    <div class="flex flex-col w-full">
                        <select class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('edit_tipe') border-red-500 @enderror"
                                wire:model.fill="edit_tipe">
                            <option value="" selected>-- Hiraukan jika tidak diubah --</option>
                            @foreach($tipe_service_list as $w)
                                <option value="{{$w->id}}">{{$w->nama_tipe_service}}</option>
                            @endforeach
                        </select>
                        @error('edit_tipe')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-row gap-5">
                    <label class="font-medium min-w-[125px]">Keluhan</label>
                    <div class="flex flex-col w-full">
                        <textarea wire:model.fill="edit_permasalahan" name="preDiagnostic" id="NamaAlamat" class="min-h-32 bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('edit_permasalahan') border-red-500 @enderror">{{$serviceData->permasalahan}}</textarea>
                        @error('edit_permasalahan')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col w-[20%] bg-white shadow-md rounded-lg">
            <div class="flex px-5 py-3 border-b-1 border-blue-100">
                <p class="text-xl font-medium">Informasi Pelanggan</p>
            </div>
            <div class="flex flex-col p-5 gap-5 [&_p]:font-semibold">
                <div class="flex flex-col">
                    <h2 class="font-medium min-w-[125px]">Nomor Servis</h2>
                    <p class="">{{$serviceData->nomor_service}}</p>
                </div>
                <div class="flex flex-col">
                    <h2 class="font-medium min-w-[125px]">Pelanggan</h2>
                    <p class="">{{$serviceData->pelanggan_dps->nama}}</p>
                </div>
                <div class="flex flex-col">
                    <h2 class="font-medium min-w-[125px]">Tanggal Permintaan</h2>
                    <p class="">{{$serviceData->waktu_mulai}}</p>
                </div>
            </div>
        </div>
    </form>
    <div class="flex flex-row gap-5">
        <div class="flex flex-col w-[80%] gap-10">
            <div class="flex flex-col bg-white shadow-md rounded-lg">
                <div class="flex flex-row justify-between px-5 py-3 border-b-1 shadow-lg border-blue-100">
                    <p class="text-xl font-medium">Aktivitas Status Tiket</p>
                </div>
                <div class="flex flex-col border-blue-100 mb-5 mx-2 gap-5 overflow-hidden py-5 [&_p]:font-semibold">
                    <table class="w-full table-auto max-w-full max-xl:text-sm max-lg:text-[10px] max-lg:[&_tbody_tr_td]:text-[10px] max-md:[&_tbody_tr_td]:text-xs">
                        <thead class="bg-gray-100 ">
                            <tr class="">
                                <th class="text-left p-2">Tanggal</th>
                                <th class="text-left p-2">Log Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($statusNote as $n)
                                <tr class="border-t hover:bg-blue-50 max-xl:[&>*]:text-[12px] max-lg:[&>*]:text-[10px]">
                                    <td class="w-[200px] p-2 py-5">{{$n->created_at}}</td>
                                    <td class="min-w-25 p-2">{{$n->status_note}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="p-4  text-gray-500">Tidak ada log status.</td>
                                    <td colspan="9" class="p-4  text-gray-500"></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{-- <div class="h-[2px] w-full shadow-lg bg-blue-100"></div> --}}
                <div class="flex flex-col gap-5 shadow-lg">
                    <div class="p-3">
                        {{$note->links('vendor.livewire.tailwind')}}
                    </div>
                </div>
            </div>
            @if ($serviceData->status != 4)
                <div class="flex flex-col bg-white shadow-md rounded-lg">
                    <div class="flex flex-row justify-between px-5 py-3 border-b-1 shadow-lg border-blue-100">
                        <p class="text-xl font-medium">Aktivitas Servis</p>
                        @if ($serviceData->id_teknisi == session(key:'user_id') && $serviceData->status != 1 && $serviceData->status != 4)
                            <button type="button" x-on:click="$dispatch('open-modal', {name: 'notedps+'})" class="bg-[#0f387a] border border-[#132c53] max-w-fit max-h-fit text-white font-medium px-2 py-1 rounded-lg hover:bg-[#0b4095] cursor-pointer">
                                New Notes +
                            </button>   
                        @endif
                    </div>
                    <div class="flex flex-col border-blue-100 mb-5 mx-2 gap-5 overflow-hidden py-5 [&_p]:font-semibold">
                        <table class="w-full table-auto max-w-full max-xl:text-sm max-lg:text-[10px] max-lg:[&_tbody_tr_td]:text-[10px] max-md:[&_tbody_tr_td]:text-xs">
                            <thead class="bg-gray-100 ">
                                <tr class="">
                                    <th class="text-left p-2">Tanggal</th>
                                    <th class="text-left p-2">Log</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($note as $n)
                                    <tr class="border-t hover:bg-blue-50 max-xl:[&>*]:text-[12px] max-lg:[&>*]:text-[10px]">
                                        <td class="w-[200px] p-2 py-5">{{$n->created_at}}</td>
                                        <td class="min-w-25 p-2">{{$n->note_content}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="p-4  text-gray-500">Tidak ada log aktivitas.</td>
                                        <td colspan="9" class="p-4  text-gray-500"></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="h-[2px] w-full shadow-lg bg-blue-100"></div> --}}
                    <div class="flex flex-col gap-5 shadow-lg">
                        <div class="p-3">
                            {{$note->links('vendor.livewire.tailwind')}}
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="flex flex-col w-[20%] h-fit bg-white shadow-md rounded-lg">
            <form wire:submit.prevent="editTiketDpsDataTeknisi()">
                <div class="flex px-5 py-3 border-b-1 border-blue-100 justify-between">
                    <p class="text-xl font-medium">Teknisi</p>
                    <div class="flex flex-col gap-5 items-end">
                        @if ($serviceData->status != 4)
                            <button x-data = "{ show: false }"
                                    x-on:open-edit-techlog-teknisi.window="show = !show"
                                    x-on:click="$dispatch('open-edit-techlog-teknisi')"
                                    type="button"
                                    class="bg-[#0f387a] border border-[#132c53] max-w-fit max-h-fit text-white font-medium px-2 py-1 rounded-lg hover:bg-[#0b4095] cursor-pointer"
                                    :class="{ 'bg-red-500/80 hover:bg-red-500/80 hover:opacity-60 border-red-500/80 ': show }"
                                    x-text="show ? 'Cancel' : 'Edit'">
                            </button> 
                            {{-- teknisiList --}}
                            <button x-data = "{ show: false }"
                                    x-on:open-edit-techlog-teknisi.window="show = !show"
                                    type="submit"
                                    class="hidden bg-[#0f387a] border border-[#132c53] max-w-fit max-h-fit text-white font-medium px-2 py-1 rounded-lg hover:bg-[#0b4095] cursor-pointer"
                                    :class="{ 'inline': show }">
                                Confirm
                            </button> 
                        @endif
                    </div>
                    {{-- <button type="submit" class="bg-[#0f387a] border border-[#132c53] max-w-fit max-h-fit text-white font-medium px-3 py-1 rounded-lg hover:bg-[#0b4095] cursor-pointer">
                        Edit
                    </button>  --}}
                </div>
                <div x-data = "{ show: false }"
                    x-on:open-edit-techlog-teknisi.window="show = !show"
                    class="flex flex-col p-5 gap-5 [&_p]:font-semibold"
                    :class="{'hidden w-full': show}"
                    >
                    <div class="flex flex-col">
                        <h2 class="font-medium min-w-[125px]">Nama Teknisi</h2>
                        <p class="">{{$serviceData->teknisi_dps->username}}</p>
                    </div>
                    <div class="flex flex-col">
                        <h2 class="font-medium min-w-[125px]">Jadwal</h2>
                        @if ($serviceData->jadwal_kunjungan)
                            <p class="">{{$serviceData->jadwal_kunjungan}}</p>
                        @else
                            <p>Belum Dijadwalkan</p>
                        @endif
                    </div>
                </div>
                <div x-data = "{ show: false }"
                    x-on:open-edit-techlog-teknisi.window="show = !show"
                    class="hidden w-full flex-col p-5 gap-5 [&_p]:font-semibold"
                    :class="{'inline-flex': show}"
                    >
                    <div class="flex flex-col gap-5">
                        <label class="font-medium min-w-[125px]">Nama Teknisi</label>
                        <div class="flex flex-col w-full">
                            <select class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('edit_teknisi_assign') border-red-500 @enderror"
                                    wire:model.fill="edit_teknisi_assign">
                                <option value="" selected>-- Hiraukan jika tidak diubah --</option>
                                @foreach($teknisiList as $w)
                                    <option value="{{$w->id}}">{{$w->username}}</option>
                                @endforeach
                            </select>
                            @error('edit_teknisi_assign')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <label class="font-medium min-w-[125px]">Jadwal</label>
                        <div class="flex flex-col w-full">
                            <input wire:model="edit_jadwal_kunjungan" value="{{ $serviceData->jadwal_kunjungan }}" type="date" class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('edit_jadwal_kunjungan') border-red-500 @enderror">
                                @error('edit_jadwal_kunjungan')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                        </div>
                        {{-- <p class="">{{$serviceData->jadwal_kunjungan}}</p> --}}
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="pb-5">
        @if (session()->has('success'))
            <div class="w-full pl-10 pr-10" role="alert">
                <p class="bg-green-100 font-semibold text-xl text-gray-400 w-full p-2 pl-5 rounded-2xl border border-green-400">
                Success: <span class="text-green-600 text-lg font-medium">{{ session('success') }}</span>
                </p>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="w-full pl-10 pr-10" role="alert">
                <p class="bg-red-100 font-semibold text-xl text-gray-400 w-full p-2 pl-5 rounded-2xl border border-red-400">
                    Error: <span class="text-red-600 text-lg font-medium">{{ session('error') }}</span>
                </p>
            </div>
        @endif
    </div>
        <x-modal-NoteCreate-Dps name="notedps+" title="Test">
        </x-modal-NoteCreate-Dps>
</div>

