<div class="flex flex-col w-auto pl-10 pr-10 pb-10 gap-15 max-md:px-5">
    <div class="flex flex-col border border-amber-300 bg-white py-10 px-10 rounded-4xl gap-10 shadow-lg">
        <p class="self-center">
            If you look to others for fulfillment, you will never truly be fulfilled.
        </p>
        <div>
            <div class="flex flex-col ">
                <label for="searchN">
                    Customer Name 
                </label>
                <input wire:model.live.debounce.200ms="nameSearch" type="text" name="" id="searchN" placeholder="Search..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block p-2.5">
            </div>
        </div>
        <div class="bg-amber-400 h-[1px] w-full self-center hidden max-md:inline"></div>
        <div class="flex flex-col overflow-x-scroll rounded-2xl">
            <table class="w-full table-auto min-w-screen max-w-full max-xl:text-sm max-lg:text-[10px] max-lg:[&_tbody_tr_td]:text-[10px]">
                <thead class="bg-gray-200 border-t border-gray-200 pl-3">
                    <tr class="gap-3">
                        <th class="text-left p-2" style="width: 50px;">ID</th>
                        <th class="text-left p-2" style="width: 200px;">Status</th>
                        <th class="text-left p-2" style="width: 10%;">Created By</th>
                        <th class="text-left p-2" style="width: 10%;">Created At</th>
                        <th class="text-left p-2" style="max-width: 100px">Note Content</th>
                    </tr>
                </thead>
                <tbody>
                        <tr class="border-t">
                            <td class="p-2 pt-5 pb-5 ">
                                d
                            </td>
                            <td class="p-2 pt-5 pb-5 ">
                                d
                            </td>
                            <td class="p-2 ">f</td>
                            <td class="p-2 ">f</td>
                            <td class="p-2 ">e</td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
