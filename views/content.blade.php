
	<h1>{{$title}}</h1>
		<p>The current UNIX timestamp is {{ time() }}.</p>
		<p>
			@if (count($records) === 1)
			    I have one record!
			@elseif (count($records) > 1)
			    I have multiple records!
			@else
			    I don't have any records!
			@endif
		</p>

		<p>
			@for ($i = 0; $i < 8; $i++)
			    The current value is {{ $i }}
			@endfor

			@foreach ($users as $user)
			    <p>This is user {{ $user->id }}</p>
			@endforeach

			@forelse ($users as $user)
			    <li>{{ $user->name }}</li>
			@empty
			    <p>No users</p>
			@endforelse

		</p>
{{ 'tes' }}

		<code>{{$url}}</code>
