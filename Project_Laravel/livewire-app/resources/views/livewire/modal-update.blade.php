@php
    // We can use the StatusModel to get the labels and colors,
    // which makes the code more dynamic and easier to maintain.
    $statusMap = $statuses->pluck('status_type', 'id')->toArray();
    $statusColorMap = [
        1 => 'bg-[#888080]', // Open
        2 => 'bg-[#FF9F17]', // On Progress
        3 => 'bg-[#D516A4]', // Pending
        4 => 'bg-[#C547F6]', // RMA
        5 => 'bg-[#1A96FF]', // On-QC
        6 => 'bg-[#1CA717]', // Completed
        7 => 'bg-[#D40000]', // Canceled
        8 => 'bg-[#1657FF]', // Returned
    ];

    $statusMainLabel = 'N/A';
    $statusMainCol = 'bg-gray-400';
    $statusNewLabel = 'N/A';
    $statusNewCol = 'bg-gray-400';
    $toNewCol = 'text-gray-400';

    if ($this->techlogIdSelector) {
        $currentStatusId = $this->techlogIdSelector->status_id;
        $statusMainLabel = $statusMap[$currentStatusId] ?? 'N/A';
        $statusMainCol = $statusColorMap[$currentStatusId] ?? 'bg-gray-400';

        // Get the new status ID based on the same logic as the controller
        $statusValueNew = $currentStatusId;
        if ($currentStatusId >= 1 && $currentStatusId <= 5) {
            $statusValueNew += 1;
        } elseif ($currentStatusId === 6) {
            $statusValueNew = 8;
        }

        $statusNewLabel = $statusMap[$statusValueNew] ?? 'N/A';
        $statusNewCol = $statusColorMap[$statusValueNew] ?? 'bg-gray-400';
        $toNewCol = str_replace('bg-', 'text-', $statusNewCol);
    }
@endphp
<div class="flex flex-col overflow-clip">
    @if ($this->techlogIdSelector)
        <div class="flex flex-col p-5 gap-5">
            <h1 class="text-3xl text-[#F18D0B] font-bold self-center">
                Update Status
            </h1>
            <div>
                {{-- No need for a form tag here, Livewire button actions handle the submission --}}
                <div class="flex flex-col w-fit gap-2">
                    <p class="text-lg font-bold">
                        Confirm status changes for the proceeding ticket:
                    </p>
                    <div class="flex flex-row">
                        <div class="flex flex-col w-fit gap-2">
                            <p>Techlog ID</p>
                            <p>Change Status Value</p>
                        </div>
                        <div class="flex flex-col w-fit gap-2">
                            <p>&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;</p>
                            <p>&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;</p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <p>{{ $this->techlogIdSelector->techlog_id }}</p>
                            <div>
                                <div class="flex flex-row items-center gap-2">
                                    <div class="flex justify-center text-white p-1 pl-2 pr-2 rounded-4xl {{ $statusMainCol }}">
                                        <p>{{ $statusMainLabel }}</p>
                                    </div>
                                    <p class="font-medium {{ $toNewCol }}">
                                        to ->
                                    </p>
                                    <div class="flex justify-center text-white p-1 pl-2 pr-2 rounded-4xl {{ $statusNewCol }}">
                                        <p>{{ $statusNewLabel }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col mt-4 gap-2">
                    <label for="note_update" class="block text font-bold text-[#302714]">
                        Note
                    </label>
                    <textarea
                        id="note_update"
                        style="min-height: 300px"
                        wire:model.live="note_update"
                        class="bg-gray-50 border overflow-y-scroll border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 w-full p-2.5"
                    ></textarea>
                </div>
            </div>
        </div>
        <div class="bg-amber-400 border-gray-100 border-t" style="height: 1px;"></div>
        <div class="flex flex-row justify-between p-5 border-gray-200 border-t items-center md:[&>*]:text-sm max-md:flex-col max-md:gap-5 max-md:items-baseline">
            <div class="flex flex-row justify-between gap-5">
                {{-- Cancel Button --}}
                <button type="button"
                    x-data
                    x-on:click="if (confirm('Are you sure you want to cancel this order?')) { $wire.cancelStatus(); }"
                    class="hover:text-white text-[#302714] px-4 py-2 rounded-2xl border border-red-300 hover:bg-red-600 cursor-pointer">
                    Cancel Order
                </button>
                
                {{-- Finish/Skip Button --}}
                @if ($this->techlogIdSelector->status_id == 2)
                    <button type="button"
                        x-data
                        x-on:click="if (confirm('Are you sure you want to Finish this order to -> Completed?')) { $wire.skipStatus(); }"
                        class="hover:text-white text-[#302714] px-4 py-2 rounded-2xl border border-amber-500 hover:bg-amber-500 cursor-pointer">
                        Finish Order
                    </button>
                @else
                    {{-- Revert Button --}}
                    <button type="button"
                        x-data
                        @if($this->techlogIdSelector->status_id == 5)
                            x-on:click="if (confirm('Are you sure you want to revert this order to -> Pending?')) { $wire.revertStatus(); }"
                        @endif
                        class="hover:text-white text-[#302714] px-4 py-2 rounded-2xl border border-amber-500 hover:bg-amber-500 cursor-pointer"
                        style="@if($this->techlogIdSelector->status_id !== 5) cursor: not-allowed; background-color: transparent; color: rgb(48, 39, 20); border-color: rgb(255, 193, 7); @endif"
                    >
                        Revert to Pending
                    </button>
                @endif
            </div>
            <div class="bg-amber-400 h-[1px] w-full self-center hidden max-md:inline"></div>
            <div class="flex flex-row justify-between gap-5 max-md:w-full">
                <button wire:click="$dispatch('close-modal')" class="cursor-pointer px-4 py-2 border rounded-2xl bg-amber-500 border-gray-200 hover:opacity-60 text-white">
                    Close
                </button>
                <button
                    type="button"
                    wire:click="updateStatus()"
                    class="cursor-pointer px-4 py-2 border rounded-2xl bg-indigo-600 border-gray-200 hover:opacity-60 text-white">
                    Confirm
                </button>
            </div>
        </div>
    @else
        <p>No service log found for the given ID.</p>
    @endif
</div>