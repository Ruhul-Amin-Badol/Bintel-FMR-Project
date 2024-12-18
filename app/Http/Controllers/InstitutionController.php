<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use App\Models\InstitutionCategory;
use App\Models\InstitutionClass;
use App\Models\InstitutionGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InstitutionController extends Controller
{
    /**
     * Get all institutions for the logged-in officer.
     */
    public function index(Request $request)
    {
        $employee_id = $request->user()->employee_id;

        $today = now()->toDateString();

        $institutions = Institution::where('employee_id', $employee_id)
            ->whereDate('date', $today)
            ->select('id', 'employee_id', 'date', 'institution_name', 'designation', 'teachers_name', 'contact_number', 'detail_address')
            ->get();

        $entrycount = $institutions->count();

        if ($institutions->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'No institutions found'], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'institutions retrieved successfully',
            'count' => $entrycount,
            'data' => $institutions,
        ], 200);
    }

    /**
     * Get all institutions .
     */

    public function getAllInstitutions(Request $request)
    {
    $employeeId = $request->input('employee_id');
    $date = $request->input('date');

    $query = Institution::query() ->with(['categories', 'classes', 'groups']);

    if ($employeeId) {
        $query->where('employee_id', $employeeId);
    }

    if ($date) {
        $query->whereDate('date', $date);
    }
        $institutions = $query->paginate(10);

        $entryCount = $institutions->count();

        if ($institutions->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No institutions found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'All institutions retrieved successfully',
            'count' => $entryCount, 
            'data' => $institutions,
        ], 200);
    }

    /**
     * Store a new institution.
     */
    public function store(Request $request)
    {
        // Split comma-separated strings into arrays
        $request->merge([
            'categories' => explode(',', $request->input('categories', '')),
            'classes' => explode(',', $request->input('classes', '')),
            'groups' => explode(',', $request->input('groups', '')),
        ]);

        // Validate request data
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'institution_name' => 'required|string',
            'designation' => 'required|string',
            'teachers_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'detail_address' => 'required|string',
            'area_name' => 'required|string',
            'division' => 'required|string',
            'zilla' => 'required|string',
            'upazilla' => 'required|string',
            'union_name' => 'required|string',
            'teachers_quantity' => 'required|integer',
            'student_quantity' => 'required|integer',
            'teachers_comment' => 'nullable|string',
            'senior_sales_executive_comments' => 'nullable|string',
            'categories' => 'required|array',
            'categories.*' => 'required|string',
            'classes' => 'required|array',
            'classes.*' => 'required|string',
            'groups' => 'required|array',
            'groups.*' => 'required|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 422);
        }

        // Create institution data
        $validated = $validator->validated();
        $validated['employee_id'] = $request->user()->employee_id;

        $institution = Institution::create($validated);

        // Attach categories
        foreach ($validated['categories'] as $category) {
            InstitutionCategory::create(['institution_id' => $institution->id, 'category' => $category]);
        }

        // Attach classes
        foreach ($validated['classes'] as $class) {
            InstitutionClass::create(['institution_id' => $institution->id, 'class' => $class]);
        }

        // Attach groups
        foreach ($validated['groups'] as $group) {
            InstitutionGroup::create(['institution_id' => $institution->id, 'group_name' => $group]);
        }

        // Load relationships for response
        $institution->load('categories', 'classes', 'groups');

        return response()->json(['status' => 'success', 'message' => 'Institution created successfully', 'data' => $institution], 201);
    }

    /**
     * Show a specific institution.
     */
    public function show($id, Request $request)
    {
        $employee_id = $request->user()->employee_id;

        $institution = Institution::where('id', $id)
            ->where('employee_id', $employee_id)
            ->with(['categories', 'classes', 'groups'])
            ->first();

        if (!$institution) {
            return response()->json(['status' => 'error', 'message' => 'Institution not found or access denied'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $institution], 200);
    }

    /**
     * Update an institution.
     */
    public function update(Request $request, $id)
    {
        $institution = Institution::findOrFail($id);

        // Split comma-separated strings into arrays
        $request->merge([
            'categories' => explode(',', $request->input('categories', '')),
            'classes' => explode(',', $request->input('classes', '')),
            'groups' => explode(',', $request->input('groups', '')),
        ]);

        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'institution_name' => 'required|string|max:255',
            'designation' => 'required|string',
            'teachers_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'detail_address' => 'required|string',
            'area_name' => 'required|string',
            'division' => 'required|string',
            'zilla' => 'required|string',
            'upazilla' => 'required|string',
            'union_name' => 'required|string',
            'teachers_quantity' => 'required|integer',
            'student_quantity' => 'required|integer',
            'teachers_comment' => 'nullable|string',
            'senior_sales_executive_comments' => 'nullable|string',
            'categories' => 'required|array',
            'categories.*' => 'required|string',
            'classes' => 'required|array',
            'classes.*' => 'required|string',
            'groups' => 'required|array',
            'groups.*' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 422);
        }

        $validated = $validator->validated();

        $institution->update($validated);

        InstitutionCategory::where('institution_id', $id)->delete();
        foreach ($validated['categories'] as $category) {
            InstitutionCategory::create(['institution_id' => $id, 'category' => $category]);
        }

        InstitutionClass::where('institution_id', $id)->delete();
        foreach ($validated['classes'] as $class) {
            InstitutionClass::create(['institution_id' => $id, 'class' => $class]);
        }

        InstitutionGroup::where('institution_id', $id)->delete();
        foreach ($validated['groups'] as $group) {
            InstitutionGroup::create(['institution_id' => $id, 'group_name' => $group]);
        }

        $institution->load('categories', 'classes', 'groups');

        return response()->json(['status' => 'success', 'message' => 'Institution updated successfully'], 200);
    }

    /**
     * Delete an institution.
     */
    public function destroy($id)
    {
        $institution = Institution::findOrFail($id);

        $institution->categories()->delete();
        $institution->classes()->delete();
        $institution->groups()->delete();
        $institution->delete();

        return response()->json(['status' => 'success', 'message' => 'Institution deleted successfully'], 200);
    }
}
