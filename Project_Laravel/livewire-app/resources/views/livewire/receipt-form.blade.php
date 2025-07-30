<div class="flex flex-col p-10 gap-8">
    {{-- A good traveler has no fixed plans and is not intent upon arriving. {{$id}} --}}

    <div class="flex flex-row justify-between items-end pr-20">
        <div class="flex flex-col gap-5">
            <img src="../icon_SLOverview/bhinneka-logo.svg" alt="asdas" style="width: 70%">
            <div class="flex flex-col [&>*]:text-[10px] [&>*]:text-justify">
                <p>Jl. Gunung Sahari Raya No. 73C5-6, Jakarta 10610</p>
                <p>Telp: (012) 2929-2828</p>
                <p>Email: support@bhinneka.com</p>
            </div>
        </div>
        <div class="flex flex-col items-center gap-1">
            <h1 class="font-bold text-3xl">RECEIPT FORM</h1>
            <h2 class="font-semibold text-2xl">Service Dept.</h2>
        </div>
    </div>
    <div class="flex flex-col gap-5">
        <div class="relative flex flex-row gap-1 [&>*]:border [&>*]:w-full [&>*]:p-3">
            <div class="flex flex-col justify-between gap-2 [&>*]:text-[10px] [&>*]:text-justify">
                <div class="flex flex-row [&>*]:w-full">
                    <p class="max-w-3/12">Tech Log No</p>
                    <p class="max-w-fit pr-2">:&nbsp;</p>
                    <p>
                        @if ($tl->techlog_id)
                            {{$tl->techlog_id}}
                        @else
                            N/A
                        @endif
                    </p>
                </div>
                <div class="flex flex-row [&>*]:w-full">
                    <p class="max-w-3/12">Date</p>
                    <p class="max-w-fit pr-2">:&nbsp;</p>
                    <p>
                        @if ($tl->date_in)
                            {{$tl->date_in}}
                        @else
                            N/A
                        @endif
                    </p>
                </div>
            </div>
            <div class="relative flex flex-col gap-2 [&>*]:text-[10px] [&>*]:text-justify">
                {{-- <div class="absolute pl-2 pr-2 -top-2 z-1 bg-white left-10">
                    <b>Description</b>
                </div> --}}
                <div class="flex flex-row [&>*]:w-full">
                    <p class="max-w-3/12">Received From</p>
                    <p class="max-w-fit">:&nbsp;</p>
                    <b>
                        @if ($tl->received_from)
                            {{$tl->received_from}}
                        @else
                            N/A
                        @endif
                    </b>
                </div>
                <div class="flex flex-row [&>*]:w-full">
                    <p>
                        @if ($tl->address)
                            {{$tl->address}}
                        @else
                            Address N/A
                        @endif
                    </p>
                </div>
                <div class="flex flex-row [&>*]:w-full">
                    <p class="max-w-3/12">Mobile</p>
                    <p class="max-w-fit">:&nbsp;</p>
                    <p>
                        @if ($tl->mobile_number)
                            {{$tl->mobile_number}}
                        @else
                            N/A
                        @endif
                    </p>
                </div>
                <div class="flex flex-row [&>*]:w-full">
                    <p class="max-w-3/12">Telephone</p>
                    <p class="max-w-fit">:&nbsp;</p>
                    <p>

                    </p>
                </div>
                <div class="flex flex-row [&>*]:w-full">
                    <p class="max-w-3/12">Contact Person</p>
                    <p class="max-w-fit">:&nbsp;</p>
                    <p>
                        @if ($tl->contact_person)
                            {{$tl->contact_person}}
                        @else
                            N/A
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="relative flex flex-row gap-1 [&>*]:border [&>*]:w-full [&>*]:p-3">
            <div class="flex flex-col gap-2 [&>*]:text-[10px] [&>*]:text-justify">
                <div class="absolute pl-2 pr-2 -top-2 z-1 bg-white left-10">
                    <b>Item</b>
                </div>
                <div class="flex flex-row [&>*]:w-full">
                    <p class="max-w-3/12">S/N</p>
                    <p class="max-w-fit pr-2">:&nbsp;</p>
                    <p>
                        @if ($tl->serial_number)
                            {{$tl->serial_number}}
                        @else
                            N/A
                        @endif
                    </p>
                </div>
                <div class="flex flex-row [&>*]:w-full">
                    <p class="max-w-3/12">Part No.</p>
                    <p class="max-w-fit pr-2">:&nbsp;</p>
                    <p>
                        @if ($tl->part_number)
                            {{$tl->part_number}}
                        @else
                            N/A
                        @endif
                    </p>
                </div>
                <div class="flex flex-row [&>*]:w-full">
                    <p class="max-w-3/12">SKU</p>
                    <p class="max-w-fit pr-2">:&nbsp;</p>
                    <p>
                        @if ($tl->SKU)
                            {{$tl->SKU}}
                        @else
                            N/A
                        @endif
                    </p>
                </div>
            </div>
            <div class="relative flex flex-col gap-2 [&>*]:text-[10px] [&>*]:text-justify">
                <div class="absolute pl-2 pr-2 -top-2 z-1 bg-white left-10">
                    <b>Description</b>
                </div>
                <div class="flex flex-row [&>*]:w-full">
                    <p class="max-w-3/12">Brand - Type</p>
                    <p class="max-w-fit">:&nbsp;</p>
                    <p>
                        @if ($tl->brand_type)
                            {{$tl->brand_type}}
                        @else
                            N/A
                        @endif
                    </p>
                </div>
                <div class="flex flex-row [&>*]:w-full">
                    <p class="max-w-3/12">Description</p>
                    <p class="max-w-fit">:&nbsp;</p>
                    <p>
                        @if ($tl->description_product)
                            {{$tl->description_product}}
                        @else
                            N/A
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="relative flex border p-3 pt-4 pb-4 [&>*]:text-[10px] [&>*]:text-justify">
            <div class="absolute pl-2 pr-2 -top-2 z-1 bg-white left-10">
                <b>Problem</b>
            </div>
            <p>
                @if ($tl->problem)
                    {{$tl->problem}}
                @else
                    N/A
                @endif
            </p>
        </div>
        <div class="relative flex border p-3 pt-4 pb-4 [&>*]:text-[10px] [&>*]:text-justify">
            <div class="absolute pl-2 pr-2 -top-2 z-1 bg-white left-10">
                <b>Add On</b>
            </div>
            <p>
                @if ($tl->add_on)
                    {{$tl->add_on}}
                @else
                    N/A
                @endif
            </p>
        </div>
        <div class="flex flex-row gap-5 justify-center [&>*]:text-[10px]  [&>*]:gap-1 [&>*]:justify-center [&>*]:items-center [&>*]:pt-2 [&>*]:pb-0 [&>*]:pl-3 [&>*]:pr-3">
            <div class="flex flex-col border">
                <p class="pl-3 pr-3">
                    Customer
                </p>
                <div class="h-12"></div>
                <div class="bg-gray-600 h-[1px] w-full" ></div>
                <p class="tracking-widest pl-3 pr-3">
                    (................................)
                </p>
            </div>
            <div class="flex flex-col border">
                <p class="pl-3 pr-3">
                    Receiver
                </p>
                <div class="h-12"></div>
                <div class="bg-gray-600 h-[1px] w-full" ></div>
                <p class="tracking-widest pl-3 pr-3">
                    (................................)
                </p>
            </div>
            <div class="flex flex-col border">
                <p class="pl-3 pr-3">
                    Telah Diterima Dengan Baik Oleh
                </p>
                <div class="h-12"></div>
                <div class="bg-gray-600 h-[1px] w-full" ></div>
                <p class="tracking-widest pl-3 pr-3">
                    (................................)
                </p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('set-page-title', (event) => {
                document.title = 'event.title';
            });
        });

        window.onload = function() {
                window.print();
            };

    </script>
</div>
