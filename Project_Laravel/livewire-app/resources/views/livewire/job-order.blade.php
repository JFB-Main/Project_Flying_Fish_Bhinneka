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
            <h1 class="font-bold text-2xl">JOB ORDER (ON - SITE)</h1>
            <h2 class="font-semibold text-xl">{{$tl->techlog_id}}</h2>
        </div>
    </div>
    <div class="flex flex-col gap-5">
        <div class="relative flex flex-row gap-1 [&>*]:border [&>*]:w-full">
            <div class="relative flex flex-col gap-4 [&>*]:text-[10px] [&>*]:text-justify p-3">
                <div class="absolute pl-2 pr-2 -top-2 z-1 bg-white left-10">
                    <b>Customer Information</b>
                </div>
                <div class="flex flex-col gap-2">
                    <div class="flex flex-row [&>*]:w-full">
                        <p class="max-w-3/12">Customer Name</p>
                        <p class="max-w-fit">:&nbsp;</p>
                        <p>
                            @if ($tl->received_from)
                                {{$tl->received_from}}
                            @else
                                N/A
                            @endif
                        </p>
                    </div>
                    <div class="flex flex-row [&>*]:w-full">
                        <p class="max-w-3/12">Address</p>
                        <p class="max-w-fit">:&nbsp;</p>
                        <p>
                            @if ($tl->alamat)
                                {{$tl->alamat}}
                            @else
                                N/A
                            @endif
                        </p>
                    </div>
                    <div class="flex flex-row [&>*]:w-full">
                        <p class="max-w-3/12">Phone</p>
                        <p class="max-w-fit">:&nbsp;</p>
                        <p>
                            @if ($tl->mobile_number)
                                {{$tl->mobile_number}}
                            @else
                                N/A
                            @endif
                        </p>
                    </div>
                </div>
                <hr>
                <div class="flex flex-col gap-2">
                <div class="flex flex-row [&>*]:w-full">
                    <u class="font-bold">Contact Person</u>
                </div>
                    <div class="flex flex-row [&>*]:w-full">
                        <p class="max-w-3/12">Name</p>
                        <p class="max-w-fit">:&nbsp;</p>
                        <p>
                            @if ($tl->contact_person)
                                {{$tl->contact_person}}
                            @else
                                N/A
                            @endif
                        </p>
                    </div>
                    <div class="flex flex-row [&>*]:w-full">
                        <p class="max-w-3/12">Mobile</p>
                        <p class="max-w-fit">:&nbsp;</p>
                        <p>
                            @if ($tl->mobile_number)
                                {{$tl->mobile_number    }}
                            @else
                                N/A
                            @endif
                        </p>
                    </div>
                    <div class="flex flex-row [&>*]:w-full">
                        <p class="max-w-3/12">Email</p>
                        <p class="max-w-fit">:&nbsp;</p>
                        <p>
                            @if ($tl->email)
                                {{$tl->email}}
                            @else
                                N/A
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-4 border-none p-0 [&>*]:border [&>*]:text-[10px] [&>*]:text-justify [&>*]:p-3">
                <div class="relative flex flex-col gap-2 [&>*]:text-[10px] [&>*]:text-justify">
                    <div class="absolute pl-2 pr-2 -top-2 z-1 bg-white left-10">
                        <b>Product Information</b>
                    </div>
                    <div class="flex flex-row [&>*]:w-full">
                        <p class="max-w-3/12">SN</p>
                        <p class="max-w-fit">:&nbsp;</p>
                        <b>
                            @if ($tl->serial_number)
                                {{$tl->serial_number}}
                            @else
                                N/A
                            @endif
                        </b>
                    </div>
                    <div class="flex flex-row [&>*]:w-full">
                        <p class="max-w-3/12">Part ID</p>
                        <p class="max-w-fit">:&nbsp;</p>
                        <p>
                            @if ($tl->part_number)
                                {{$tl->part_number}}
                            @else
                                N/A
                            @endif
                        </p>
                    </div>
                    <div class="flex flex-row [&>*]:w-full">
                        <p class="max-w-3/12">Brand</p>
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
                        <p class="max-w-3/12">Type</p>
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
                <div class="relative flex flex-col gap-2 [&>*]:text-[10px] [&>*]:text-justify">
                    <div class="absolute pl-2 pr-2 -top-2 z-1 bg-white left-10">
                        <b>Warranty Information</b>
                    </div>
                    <div class="flex flex-row [&>*]:w-full">
                        <p class="max-w-4/12">Invoice Date</p>
                        <p class="max-w-fit">:&nbsp;</p>
                        <b>
                            @if ($tl->invoice_date)
                                {{$tl->invoice_date}}
                            @else
                                N/A
                            @endif
                        </b>
                    </div>
                    <div class="flex flex-row [&>*]:w-full">
                        <p class="max-w-4/12">Warranty Status</p>
                        <p class="max-w-fit">:&nbsp;</p>
                        <p>
                            {{$tl->warranty_bind ? $tl->warranty_bind->warranty_status : 'N/A'}}
                        </p>
                    </div>
                    <div class="flex flex-row [&>*]:w-full">
                        <p class="max-w-4/12">Brand</p>
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
                        <p class="max-w-4/12">Extended Warranty</p>
                        <p class="max-w-fit">:&nbsp;</p>
                        <p>
                        </p>
                    </div>
                </div>
                <div class="relative flex flex-col gap-2 [&>*]:text-[10px] [&>*]:text-justify">
                    <div class="absolute pl-2 pr-2 -top-2 z-1 bg-white left-10">
                        <b>Technical Log References</b>
                    </div>
                    <div class="flex flex-row [&>*]:w-full">
                        <p class="max-w-4/12">TL No.</p>
                        <p class="max-w-fit">:&nbsp;</p>
                        <p>
                            {{$tl->techlog_id ? $tl->techlog_id : 'N/A'}}
                        </p>
                    </div>
                    <div class="flex flex-row [&>*]:w-full">
                        <p class="max-w-4/12">TL Date</p>
                        <p class="max-w-fit">:&nbsp;</p>
                        <p>
                            {{$tl->created_at ? $tl->created_at : 'N/A'}}
                        </p>
                    </div>
                    <div class="flex flex-row [&>*]:w-full">
                        <p class="max-w-4/12">Sales Order</p>
                        <p class="max-w-fit">:&nbsp;</p>
                        <p>
                            {{$tl->sales_order ? $tl->sales_order : 'N/A'}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="relative flex flex-row gap-1 [&>*]:border [&>*]:w-full [&>*]:p-3">
            <div class="flex flex-col gap-2 [&>*]:text-[10px] [&>*]:text-justify">
                <div class="absolute pl-2 pr-2 -top-2 z-1 bg-white left-10">
                    <b>Reported Problem</b>
                </div>
                <div class="flex flex-row [&>*]:w-full border p-2">
                    <p>
                        {{$tl->problem ? $tl->problem : 'N/A'}}
                    </p>
                </div>
            </div>
            <div class="relative flex flex-col gap-2 [&>*]:text-[10px] [&>*]:text-justify">
                <div class="absolute pl-2 pr-2 -top-2 z-1 bg-white left-10">
                    <b>Pre-Diagnostic</b>
                </div>
                <div class="flex flex-row [&>*]:w-full border p-2">
                    <p>
                        {{$tl->pre_diagnostic ? $tl->pre_diagnostic : 'N/A'}}
                    </p>
                </div>
            </div>
        </div>
        <div class="relative flex flex-col border p-3 pt-4 pb-4 [&>*]:text-[10px] [&>*]:text-justify">
            <div class="absolute pl-2 pr-2 -top-2 z-1 bg-white left-10">
                <b>On - Site Report</b>
            </div>
            <div class="flex flex-row justify-between items-center">
                <div class="flex flex-row w-fit">
                    <div class="flex flex-row [&>*]:w-full">
                        <b class="">On-Site Status</b>
                        <p class="max-w-fit">:&nbsp;&nbsp;</p>
                    </div>
                    <div class="flex flex-row gap-5">
                        <div class="flex flex-row items-center gap-2">
                            <div class="border self-center border-gray-500 rounded-xs size-4"></div>
                            <p>Solved</p>
                        </div>
                        <div class="flex flex-row items-center gap-2">
                            <div class="border self-center border-gray-500 rounded-xs size-4"></div>
                            <p>Unsolved</p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-row w-fit">
                    <div class="flex flex-row [&>*]:w-full">
                        <b class="">Follow Up</b>
                        <p class="max-w-fit">:&nbsp;&nbsp;</p>
                    </div>
                    <div class="flex flex-row gap-3">
                        <div class="flex flex-row items-center gap-2">
                            <div class="border self-center border-gray-500 rounded-xs size-4"></div>
                            <p>Bring To Repair Center</p>
                        </div>
                        <div class="flex flex-row items-center gap-2">
                            <div class="border self-center border-gray-500 rounded-xs size-4"></div>
                            <p>Next Visit</p>
                        </div>
                    </div>
                </div>
                <div class="border w-full h-4 self-center max-w-40">

                </div>
            </div>
        </div>
        <div class="relative flex flex-row border p-3 pt-4 pb-4 [&>*]:text-[10px] [&>*]:text-justify gap-1">
            <div class="absolute pl-2 pr-2 -top-2 z-1 bg-white left-10">
                <b>Charge Information</b>
            </div>
            <div class="relative flex flex-col border w-full [&>*]:justify-between p-3 gap-4">
                <div class="absolute pl-2 pr-2 -top-2 z-1 w-fit bg-white left-10">
                    <b>Part(s)</b>
                </div>
                <div class="flex flex-row gap-3">
                    <div class="w-1"></div>
                    <div class="flex flex-row w-full [&>*]:w-full [&>*]:flex [&>*]:justify-center [&>*]:self-center justify-between">
                        <div>
                            <p>
                                item(s)
                            </p>
                        </div>
                        <div>
                            <p>
                                Price
                            </p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="flex flex-row gap-3">
                            <p class="w-1">{{$i}}.</p>
                            <div class="border-b self-end w-full mb-1"></div>
                            <div class="border-b self-end w-full mb-1"></div>
                        </div>
                    @endfor
                </div>
            </div>
            <div class="relative flex flex-col border w-full [&>*]:justify-between p-3 gap-4">
                <div class="absolute pl-2 pr-2 -top-2 z-1 w-fit bg-white left-10">
                    <b>Service(s)</b>
                </div>
                <div class="flex flex-row gap-3">
                    <div class="w-1"></div>
                    <div class="flex flex-row w-full [&>*]:w-full [&>*]:flex [&>*]:justify-center [&>*]:self-center justify-between">
                        <div>
                            <p>
                                item(s)
                            </p>
                        </div>
                        <div>
                            <p>
                                Price
                            </p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="flex flex-row gap-3">
                            <p class="w-1">{{$i}}.</p>
                            <div class="border-b self-end w-full mb-1"></div>
                            <div class="border-b self-end w-full mb-1"></div>
                        </div>
                    @endfor
                </div>
            </div>
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
</div>
