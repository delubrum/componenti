<div class="mx-2 sm:mx-10 mt-2 sm:mt-4 px-3 sm:px-6 py-3 sm:py-6 bg-white rounded-lg shadow-md">
	<div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
		<div>
			<label for="name" class="block text-gray-600 text-sm mb-1">Full Name</label>
			<input type="text" id="name" name="name" class="w-full p-1.5 border border-gray-300 rounded-md focus:ring focus:ring-blue-500 focus:outline-none">
		</div>
		<div>
			<label for="email" class="block text-gray-600 text-sm mb-1">Email Address</label>
			<input type="email" id="email" name="email" class="w-full p-1.5 border border-gray-300 rounded-md focus:ring focus:ring-blue-500 focus:outline-none">
		</div>
		<div>
			<label for="hour" class="block text-gray-600 text-sm mb-1">Hour</label>
			<input type="number" step="0.01" id="hour" name="hour" class="w-full p-1.5 border border-gray-300 rounded-md focus:ring focus:ring-blue-500 focus:outline-none">
		</div>
		<div>
			<label for="overtime" class="block text-gray-600 text-sm mb-1">Overtime</label>
			<input type="number" step="0.01" id="overtime" name="overtime" class="w-full p-1.5 border border-gray-300 rounded-md focus:ring focus:ring-blue-500 focus:outline-none">
		</div>
		<div>
			<label for="payroll" class="block text-gray-600 text-sm mb-1">Payroll</label>
			<select id="payroll" name="payroll" class="w-full p-1.5 border border-gray-300 rounded-md focus:ring focus:ring-blue-500 focus:outline-none" style="background-color: white;">
					<option value="" disabled selected></option>
					<option value="ESM-Roldan">ESM-Roldan</option>
					<option value="Componeti">Componeti</option>
			</select>
		</div>
	</div>
</div>
