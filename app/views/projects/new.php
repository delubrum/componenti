<div @click.outside="showModal = false" class="overflow-auto w-[95%] sm:w-[25%] bg-white p-4 rounded-lg shadow-lg relative z-20">
    <!-- Close Button (X) in Top-Right Corner -->
    <button @click="showModal = !showModal" class="absolute top-0 right-0 m-3 text-gray-600 hover:text-gray-800">
        <i class="ri-close-line text-2xl"></i>
    </button>
    <h1 class="text-lg font-semibold mb-4">New</h1>
    <form id="newForm" class="overflow-y-auto max-h-[600px] p-4">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id->id : '' ?>">
        <div class="grid grid-cols-1 sm:grid-cols-1 gap-4">
            <div>
                <label for="code" class="block text-gray-600 text-sm mb-1">Code</label>
                <input value="<?php echo isset($id) ? $id->code : '' ?>" type="text" id="code" name="code" class="w-full p-1.5 border border-gray-300 rounded-md focus:ring focus:ring-blue-500 focus:outline-none" required>
            </div>
            <div>
                <label for="name" class="block text-gray-600 text-sm mb-1">Name</label>
                <input value="<?php echo isset($id) ? $id->name : '' ?>" type="text" id="name" name="name" class="w-full p-1.5 border border-gray-300 rounded-md focus:ring focus:ring-blue-500 focus:outline-none" required>
            </div>
            <div>
                <label for="scope" class="block text-gray-600 text-sm mb-1">Scope</label>
                <input value="<?php echo isset($id) ? $id->scope : '' ?>" type="text" id="scope" name="scope" class="w-full p-1.5 border border-gray-300 rounded-md focus:ring focus:ring-blue-500 focus:outline-none" required>
            </div>
        </div>
        <div class="mt-6 flex justify-end">
            <button hx-post='?c=Projects&a=Save' hx-swap="none" hx-on:htmx:after-request="table.ajax.reload( null, false );<?php echo isset($id) ? '' : "document.getElementById('newForm').reset()" ?>" type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition"><i class="ri-save-line"></i> Save</button>
        </div>
    </form>
</div>