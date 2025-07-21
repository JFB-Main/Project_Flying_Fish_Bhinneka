{{-- resources/views/livewire/modal-update.blade.php --}}
    @php
    
     if ($this->techlogIdSelector) {
        $statusValueNew = $this->techlogIdSelector->status_id+1;

        $statusMainCol = ''; // Default empty class
        $statusMainLabel = '';
        switch ($this->techlogIdSelector->status_id) {
            case 1:
                $statusMainCol = 'bg-[#888080]'; // Darker Grey for Open
                $statusMainLabel = 'Open';
                break;
            case 2:
                $statusMainCol = 'bg-[#FF9F17]'; // Darker Yellow for On Progress
                $statusMainLabel = 'On Progress';
                break;
            case 3:
                $statusMainCol = 'bg-[#D516A4]'; // Darker Purple for Pending
                $statusMainLabel = 'Pending';
                break;
            case 4:
                $statusMainCol = 'bg-[#C547F6]'; // Darker Red for RMA
                $statusMainLabel = 'RMA';
                break;
            case 5:
                $statusMainCol = 'bg-[#1A96FF]'; // Darker Indigo for On-QC
                $statusMainLabel = 'On-QC';
                break;
            case 6:
                $statusMainCol = 'bg-[#1CA717]'; // Darker Green for Completed
                $statusMainLabel = 'Completed';
                break;
            case 7:
                $statusMainCol = 'bg-[#D40000]'; // Darker Gray for Canceled
                $statusMainLabel = 'Canceled';
                break;
            case 8:
                $statusMainCol = 'bg-[#1657FF]'; // Darker Orange for Returned
                $statusMainLabel = 'Returned';
                break;
            default:
                $statusMainCol = 'bg-gray-400'; // Default for 'N/A' or unknown statuses
                $statusMainLabel = 'N/A';
                break;
        }

        $statusNewCol = '';
        $statusNewLabel = '';
        $toNewCol = '';
        switch ($this->techlogIdSelector->status_id+1) {
            case 1:
                $statusNewCol = 'bg-[#888080]'; // Darker Grey for Open
                $statusNewLabel = 'Open';
                $toNewCol = 'text-[#888080]';
                break;
            case 2:
                $statusNewCol = 'bg-[#FF9F17]'; // Darker Yellow for On Progress
                $statusNewLabel = 'On Progress';
                $toNewCol = 'text-[#FF9F17]';
                break;
            case 3:
                $statusNewCol = 'bg-[#D516A4]'; // Darker Purple for Pending
                $statusNewLabel = 'Pending';
                $toNewCol = 'text-[#D516A4]';
                break;
            case 4:
                $statusNewCol = 'bg-[#C547F6]'; // Darker Red for RMA
                $statusNewLabel = 'RMA';
                $toNewCol = 'text-[#C547F6]';
                break;
            case 5:
                $statusNewCol = 'bg-[#1A96FF]'; // Darker Indigo for On-QC
                $statusNewLabel = 'On-QC';
                $toNewCol = 'text-[#1A96FF]';
                break;
            case 6:
                $statusNewCol = 'bg-[#1CA717]'; // Darker Green for Completed
                $statusNewLabel = 'Completed';
                $toNewCol = 'text-[#1CA717]';
                break;
            case 7:
                $statusNewCol = 'bg-[#D40000]'; // Darker Gray for Canceled
                $statusNewLabel = 'Canceled';
                $toNewCol = 'text-[#D40000]';
                break;
            case 8:
                $statusNewCol = 'bg-[#1657FF]'; // Darker Orange for Returned
                $statusNewLabel = 'Returned';
                $toNewCol = 'text-[#1657FF]';
                break;
            default:
                $statusNewCol = 'bg-gray-400'; // Default for 'N/A' or unknown statuses
                $statusNewLabel = 'N/A';
                $toNewCol = 'text-gray-400';
                break;
        }
    }
@endphp
<div class="flex flex-col overflow-clip">
    <form wire:submit="updateStatus()">
        @if ($this->techlogIdSelector) {{-- Always check if the object exists before accessing properties --}}
            <div class="flex flex-col p-5 gap-5">
                <h1 class="text-3xl text-[#F18D0B] font-bold self-center">
                    Update Status
                </h1>
                <div>
                    {{-- selectedStatusId --}}
                        <input type="hidden" wire:model.fill="id_for_status_update" value="{{$this->techlogIdSelector->id}}" class="bg-gray-50 border overflow-y-scroll border-gray-300 text-gray-900 text-sm rounded-2xl">
                        <input type="hidden" wire:model.fill="status_id" value="{{$this->techlogIdSelector->status_id}}">
                        <div class="flex flex-col w-fit gap-2">
                            <p class="text-lg font-bold">
                                Confirm status changes for the proceeding ticket:
                            </p>
                            <div class="flex flex-row">
                                <div class="flex flex-col w-fit gap-2">
                                    <div class="flex flex-row">
                                        <p style="">Techlog ID</p> 
                                    </div>
                                    <div class="flex flex-row">
                                        <p style="">Change Status Value</p> 
                                    </div>
                                </div>
                                <div class="flex flex-col w-fit gap-2">
                                    <div class="flex flex-row">
                                        <p>&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;</p> 
                                    </div>
                                    <div class="flex flex-row">
                                        <p>&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;</p> 
                                    </div>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <p>{{ $this->techlogIdSelector->techlog_id }}</p>
                                    <div>
                                        {{-- Optional: Display a placeholder or handle the case where the log is not found --}}
                                        <div class="flex flex-row items-center gap-2">
                                            <div class="flex justify-center text-white p-1 pl-2 pr-2 rounded-4xl {{$statusMainCol}}">
                                                <p>{{$statusMainLabel}}</p>
                                            </div>
                                            <p class="font-medium {{$toNewCol}}">
                                                to ->
                                            </p>
                                            <div class="flex justify-center text-white p-1 pl-2 pr-2 rounded-4xl {{$statusNewCol}}">
                                                <p>{{$statusNewLabel}}</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                {{-- <p>New Status Value: {{$selectedId}}</p> --}}
                            </div>
                        </div>


                    {{-- Add your form fields or other content related to updating the status here --}}
                    <div class="flex flex-col mt-4 gap-2">
                        <label for="new_status_value" class="block text font-bold text-[#302714]">
                            Note
                        </label>
                        <textarea
                            type="textarea"
                            id="new_status_value"
                            style="min-height: 300px"
                            wire:model="note_update" 
                            class="bg-gray-50 border overflow-y-scroll border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 w-full p-2.5"
                            {{-- wire:model="someFieldToUpdate" Example: bind to a Livewire property for input --}}
                        >
                        </textarea>
                    </div>
                </div>
            </div>
            <div class="bg-amber-400 border-gray-100 border-t" style="height: 1px;"></div>
            <div class="flex flex-row justify-between p-5 border-gray-200 border-t items-center">
                        <button type="submit" 
                            x-data 
                            x-on:click="alert('Are you sure you want to delete this?')" 
                            wire:click="cancelStatus()" 
                            class="hover:text-white text-[#302714] px-4 py-2 rounded-2xl border border-red-300 hover:bg-red-600" style="max-width: 30%">
                        Cancel order
                        </button>   
                    <div class="flex flex-row justify-between gap-5">
                        <button wire:click="$dispatch('close-modal')" class="cursor-pointer px-4 py-2 border rounded-2xl bg-amber-500 border-gray-200 hover:opacity-60 text-white">
                            Close
                        </button>
                        <button 
                            {{-- x-data  --}}
                            {{-- x-on:click="$dispatch('update-data', {id_for_status_update: {{ $this->techlogIdSelector->id }}, status_id: {{$this->techlogIdSelector->status_id}} })"  --}}
                            type="submit" 
                            {{-- value="{{$this->techlogIdSelector->id}}" --}}
                            class="cursor-pointer px-4 py-2 border rounded-2xl bg-indigo-600 border-gray-200 hover:opacity-60 text-white"
                            >
                        Confirm
                        </button>
                        {{-- Add a save button here if needed --}}
                        {{-- <button wire:click="saveChanges" class="ml-2 px-4 py-2 bg-green-500 text-white rounded-md">Save</button> --}}
                    </div>
            </div>
        @else
            <p>No service log found for the given ID.</p>
        @endif
    </form>
</div>

