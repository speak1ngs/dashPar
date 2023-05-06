<div>

<a wire:click="$set('open_show',true)" class="cursor-pointer"> {{ $ci }}</a>

<x-dialog-modal wire:model="open_show">
    <x-slot name='title'>
        Contratos del cliente  {{ $nombres}}
    </x-slot>
    <x-slot name='content'>
    <table class="min-w-full divide-y divide-gray-200">

<thead class="bg-gray-50">

    <tr>

        <th scope="col" class="w-120 cursor-pointer px-12 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" wire:click="order('id')">

         Contratos
         
        </th>

        <th scope="col" class="w-120 cursor-pointer px-12 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" wire:click="order('id')">

        Tipo movimiento

        </th>

    
    </tr>

</thead>
       
        <tbody class="bg-white divide-y divide-gray-200">
            
        
        
        @foreach($selectUser as $val)



                  <tr>

							<td class="px-6 py-4">

					<a href="http://190.104.168.219/jparaiso/cp/extracta.php?id=7860">	{{	$val->contrato}}</a>
							</td>

                            <td class="px-6 py-4">

                        <a >	
                            {{	$val->tipomovim}}</a>
                                </td>
                           
                  </tr>
                  @endforeach
              </tbody>

          </table>

    </x-slot>
    <x-slot name='footer'>

    </x-slot>
</x-dialog-modal>
</div>

