<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use App\Models\Library;
use App\Models\LibraryCategory;
use App\Models\LibraryType;
use App\Models\Upazila;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LibraryController extends Controller
{
    /**
     * Get all divisions.
     */
    public function getDivisions()
    {
        $divisions = Division::all();
        return response()->json(['message' => 'Divisions retrieved successfully', 'data' => $divisions], 200);
    }

    /**
     * Get districts by division ID.
     */
    public function getDistrictsByDivision($division_id)
    {
        $districts = District::where('district_division_id', $division_id)->get();
        return response()->json(['message' => 'Districts retrieved successfully', 'data' => $districts], 200);
    }

    /**
     * Get upazilas by district ID.
     */
    public function getUpazilasByDistrict($district_id)
    {
        $upazilas = Upazila::where('upazila_district_id', $district_id)->get();
        return response()->json(['message' => 'Upazilas retrieved successfully', 'data' => $upazilas], 200);
    }

    //index function for logged-in officer wise library  show
    public function index(Request $request)
    {
        $employee_id = $request->user()->employee_id;

        // Get today's date
        $today = now()->toDateString();

        // Fetch libraries for the logged-in officer for today
        $libraries = Library::where('employee_id', $employee_id)
            ->whereDate('date', $today) // Filter by today's date
            ->select('id', 'employee_id', 'date', 'library_Name', 'owner_name', 'contact_number', 'detail_address')
            ->get();

        // Count today's entries
        $entryCount = $libraries->count();

        if ($libraries->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No libraries found for this officer today',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Libraries retrieved successfully',
            'count' => $entryCount, // Include count
            'data' => $libraries,
        ], 200);
    }

    // get all  library data without officer show all officer data
    public function getAllLibraries()
    {
        $libraries = Library::select('id', 'employee_id', 'date', 'library_Name', 'owner_name', 'contact_number', 'detail_address')->paginate(5);
        $entryCount = $libraries->count();

        if ($libraries->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No libraries found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'All libraries retrieved successfully',
            'count' => $entryCount,
            'data' => $libraries,
        ], 200);
    }

    // store library data//
    public function store(Request $request)
    {
        // Split comma-separated strings into arrays
        $request->merge([
            'categories' => explode(',', $request->input('categories')),
            'types' => explode(',', $request->input('types')),
        ]);

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'library_Name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'detail_address' => 'required|string',
            'area_name' => 'required|string',
            'division' => 'required|string',
            'upazilla' => 'required|string',
            'zilla' => 'required|string',
            'union_name' => 'required|string',
            'librarian_comments' => 'nullable|string',
            'senior_sales_executive_comments' => 'nullable|string',
            'created_by' => 'integer',
            'updated_by' => 'nullable|integer',
            'categories' => 'required|array',
            'categories.*' => 'required|string',
            'types' => 'required|array',
            'types.*' => 'required|string',
        ], [
            'date.required' => 'The date field is required.',
            'library_Name.required' => 'The library name is required.',
            'owner_name.required' => 'The owner name is required.',
            'contact_number.required' => 'The contact number is required.',
            'detail_address.required' => 'The address is required.',
            'area_name.required' => 'The area name is required.',
            'division.required' => 'The division is required.',
            'upazilla.required' => 'The upazilla is required.',
            'zilla.required' => 'The zilla is required.',
            'union_name.required' => 'The union name is required.',
            'created_by.required' => 'The created by field is required.',
            'categories.required' => 'The categories field is required.',
            'categories.*.required' => 'Each category is required.',
            'types.required' => 'The types field is required.',
            'types.*.required' => 'Each type is required.',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            $firstError = $validator->errors()->first(); // Get the first validation error message
            return response()->json([
                'status' => 'error',
                'message' => $firstError,
            ], 422);
        }

        // Attach the employee_id of the logged-in officer
        $validated = $validator->validated();
        $validated['employee_id'] = $request->user()->employee_id;

        // Create the Library
        $library = Library::create($validated);

        // Store Categories
        foreach ($validated['categories'] as $category) {
            LibraryCategory::create([
                'library_id' => $library->id,
                'category' => $category,
            ]);
        }

        // Store Types
        foreach ($validated['types'] as $type) {
            LibraryType::create([
                'library_id' => $library->id,
                'library_type' => $type,
            ]);
        }

        // Load relationships for response
        $library->load('categories', 'types');

        return response()->json([
            'status' => 'success',
            'message' => 'Library data created successfully',
            'data' => $library,
        ], 201);
    }

    //show function for specific officer show her data
    public function show($id, Request $request)
    {
        $employee_id = $request->user()->employee_id;

        // Fetch library and ensure it belongs to the logged-in officer
        $library = Library::where('id', $id)
            ->where('employee_id', $employee_id)
            ->with(['categories', 'types', 'divisionData', 'district', 'upazila'])
            ->first();

        if (!$library) {
            return response()->json([
                'status' => 'error',
                'message' => 'Library not found or you do not have permission to view it',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Library retrieved successfully',
            'data' => $library,
        ], 200);
    }

    //edit library data
    public function edit($id)
    {
        $library = Library::with(['categories', 'types', 'divisionData', 'district', 'upazila'])->findOrFail($id);

        return response()->json([
            'status' => 'Success',
            'message' => 'Library data retrieved(Edit) successfully',
            'data' => $library,
        ], 200);
    }

    //update library data
    public function update(Request $request, $id)
    {
        $library = Library::findOrFail($id);

        // Merge and convert comma-separated values to arrays for categories and types
        $request->merge([
            'categories' => explode(',', $request->input('categories')),
            'types' => explode(',', $request->input('types')),
        ]);

        // Validate the request
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'library_Name' => 'required|string',
            'owner_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'detail_address' => 'required|string',
            'area_name' => 'required|string',
            'division' => 'required|string',
            'upazilla' => 'required|string',
            'zilla' => 'required|string',
            'union_name' => 'required|string',
            'librarian_comments' => 'nullable|string',
            'senior_sales_executive_comments' => 'nullable|string',
            'created_by' => 'integer',
            'updated_by' => 'nullable|integer',
            'categories' => 'required|array',
            'categories.*' => 'required|string',
            'types' => 'required|array',
            'types.*' => 'required|string',
        ], [
            'date.required' => 'The date field is required.',
            'library_Name.required' => 'The library name is required.',
            'owner_name.required' => 'The owner name is required.',
            'contact_number.required' => 'The contact number is required.',
            'detail_address.required' => 'The address is required.',
            'area_name.required' => 'The area name is required.',
            'division.required' => 'The division is required.',
            'upazilla.required' => 'The upazilla is required.',
            'zilla.required' => 'The zilla is required.',
            'union_name.required' => 'The union name is required.',
            'created_by.required' => 'The created by field is required.',
            'categories.required' => 'The categories field is required.',
            'categories.*.required' => 'Each category is required.',
            'types.required' => 'The types field is required.',
            'types.*.required' => 'Each type is required.',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            $firstError = $validator->errors()->first();
            return response()->json([
                'status' => 'error',
                'message' => $firstError,
            ], 422);
        }

        // Attach the employee_id of the logged-in officer
        $validated = $validator->validated();
        $validated['employee_id'] = $request->user()->employee_id;

        // Update the Library
        $library->update($validated);

        // Sync Categories
        LibraryCategory::where('library_id', $id)->delete();
        foreach ($validated['categories'] as $category) {
            LibraryCategory::create([
                'library_id' => $library->id,
                'category' => $category,
            ]);
        }

        // Sync Types
        LibraryType::where('library_id', $id)->delete();
        foreach ($validated['types'] as $type) {
            LibraryType::create([
                'library_id' => $library->id,
                'library_type' => $type,
            ]);
        }

        // Load relationships for response
        $library->load('categories', 'types');

        return response()->json([
            'status' => 'success',
            'message' => 'Library data updated successfully',
            'data' => $library,
        ], 200);
    }

    //delete library data
    public function destroy($id)
    {
        $library = Library::findOrFail($id);

        // Delete associated categories and types
        $library->categories()->delete();
        $library->types()->delete();

        // Delete the library
        $library->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Library deleted successfully',
        ], 200);
    }

}
