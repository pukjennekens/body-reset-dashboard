<div>
    @if(count($creditOrders) > 0)
        <table class="table-fixed">
            <thead>
                <td>Id</td>
                <td>Credit pakket</td>
                <td>Mollie status</td>
                <td>Prijs</td>
                <td>Mollie ID</td>
                <td>Datum</td>
            </thead>

            <tbody>
                @foreach($creditOrders as $creditOrder)
                    <tr>
                        <td class="text-sm">{{ $creditOrder->id }}</td>
                        <td class="text-sm">{{ $creditOrder->creditOption->name }}</td>
                        <td class="text-sm">{{ $creditOrder->status }}</td>
                        <td class="text-sm">{{ $creditOrder->currency . ' ' . number_format($creditOrder->price, 2) }}</td>
                        <td class="text-sm">{{ $creditOrder->payment_id }}</td>
                        <td class="text-sm">{{ $creditOrder->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Er zijn geen bestellingen gevonden.</p>
    @endif
</div>
