<div>
    @if(!empty($subUsers))
        <div class="overflow-x-auto">
            <table class="table-auto">
                <thead>
                    <th>Naam</th>
                    <th>E-mail</th>
                    <th>Telefoonnummer</th>
                    <th>Credits</th>
                    <th>Vervaldatum credits</th>
                    <th></th>
                </thead>

                <tbody>
                    @foreach($subUsers as $user)
                        <tr>
                            <td class="whitespace-nowrap">{{ $user->name }}</td>
                            <td class="whitespace-nowrap">{{ $user->email }}</td>
                            <td class="whitespace-nowrap">{{ $user->phone_number }}</td>
                            <td class="whitespace-nowrap">{{ $user->credits }}</td>
                            <td class="whitespace-nowrap">{{ $user->credits_expiration_date->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('dashboard.admin.users.show', $user) }}" class="rounded-lg px-4 py-1.5 border-0 bg-primary text-white uppercase font-semibold hover:bg-green-600">
                                    <i class="fa-solid fa-user"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>Je hebt nog geen pete- of metekinderen aan je account gekoppeld</p>
    @endif
</div>