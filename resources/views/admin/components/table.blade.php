<div class="container mx-auto px-4 py-6">
  <div class="bg-white rounded-xl shadow-md overflow-hidden">
    <!-- Table Header -->
    <div class="px-6 py-4 border-b border-gray-100">
      <h2 class="text-xl font-semibold text-gray-800">{{ $title }}</h2>
    </div>

    <!-- Table Container -->
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <!-- Table Head -->
        <thead class="bg-gray-50">
          <tr>
            @foreach($headers as $header)
              <th
                scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                {{ $header }}
              </th>
            @endforeach
          </tr>
        </thead>

        <!-- Table Body -->
        <tbody class="bg-white divide-y divide-gray-200">
          {{ $slot }}
        </tbody>
      </table>
    </div>

    <!-- Optional Table Footer -->
    @if(isset($footer))
      <div class="px-6 py-3 border-t border-gray-100 bg-gray-50">
        {{ $footer }}
      </div>
    @endif
  </div>
</div>
