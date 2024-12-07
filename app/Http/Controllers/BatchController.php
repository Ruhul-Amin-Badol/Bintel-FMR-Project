<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\BatchCategory;
use App\Models\BatchCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BatchController extends Controller
{
    /**
     * Get all batches for the logged-in officer.
     */
    public function index(Request $request)
    {
        $employee_id = $request->user()->employee_id;

        $today = now()->toDateString();

        $batches = Batch::where('employee_id', $employee_id)
            ->WhereDate('date', $today)
            ->select('id', 'employee_id', 'date', 'batch_name', 'owner_name', 'contact_number', 'detail_address')
            ->get();

        $entrycount = $batches->count();

        if ($batches->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'No batches found'], 404);
        }

        return response()->json(['status' => 'success', 'count' => $entrycount, 'data' => $batches], 200);
    }

    /**
     * Get all batches .
     */

    public function getAllBatches(Request $request)
    {
        $employeeId = $request->input('employee_id');
        $date = $request->input('date');

        $query = Batch::query();

        if ($employeeId) {
            $query->where('employee_id', $employeeId);
        }

        if ($date) {
            $query->whereDate('date', $date);
        }

        $batches =  $query->select('id', 'employee_id', 'date', 'batch_name', 'owner_name', 'contact_number', 'detail_address')->paginate(10);

        $entryCount = $batches->count();

        if ($batches->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No batches found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'All batches retrieved successfully',
            'count' => $entryCount, 
            'data' => $batches,
        ], 200);
    }

    /**
     * Store a new batch.
     */
    public function store(Request $request)
    {
        // Split comma-separated strings into arrays
        $request->merge([
            'categories' => explode(',', $request->input('categories')),
            'courses' => explode(',', $request->input('courses')),
        ]);

        // Validate request data
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'batch_name' => 'required|string|max:255',
            'owner_name' => 'required|string',
            'contact_number' => 'required|string|max:20',
            'detail_address' => 'required|string',
            'area_name' => 'required|string',
            'division' => 'required|exists:divisions,division_id',
            'zilla' => 'required|exists:districts,district_id',
            'upazilla' => 'required|exists:upazilas,upazila_id',
            'union_name' => 'required|string',
            'teachers_quantity' => 'required|integer',
            'student_quantity' => 'required|integer',
            'school_name' => 'required|string',
            'teachers_comment' => 'nullable|string',
            'senior_sales_executive_comments' => 'nullable|string',
            'categories' => 'required|array',
            'categories.*' => 'required|string',
            'courses' => 'required|array',
            'courses.*' => 'required|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 422);
        }

        // Create batch data
        $validated = $validator->validated();
        $validated['employee_id'] = $request->user()->employee_id;

        $batch = Batch::create($validated);

        // Attach categories
        foreach ($validated['categories'] as $category) {
            BatchCategory::create(['batch_id' => $batch->id, 'category' => $category]);
        }

        // Attach courses
        foreach ($validated['courses'] as $course) {
            BatchCourse::create(['batch_id' => $batch->id, 'course' => $course]);
        }
        // Load relationships for response
        $batch->load('categories', 'courses');

        return response()->json(['status' => 'success', 'message' => 'Batch Data created successfully'], 201);
    }

    /**
     * Show a specific batch.
     */
    public function show($id, Request $request)
    {
        $employee_id = $request->user()->employee_id;

        $batch = Batch::where('id', $id)
            ->where('employee_id', $employee_id)
            ->with(['divisionData', 'district', 'upazila', 'categories', 'courses'])
            ->first();

        if (!$batch) {
            return response()->json(['status' => 'error', 'message' => 'Batch not found or access denied'], 404);
        }

        return response()->json(['status' => 'success', 'message' => 'Batch retrieved successfully', 'data' => $batch], 200);
    }

    //edit batch data
    public function edit($id)
    {
        $batch = Batch::with(['categories', 'courses', 'divisionData', 'district', 'upazila'])->findOrFail($id);

        return response()->json([
            'status' => 'Success',
            'message' => 'batch data retrieved(Edit) successfully',
            'data' => $batch,
        ], 200);
    }

    /**
     * Update a batch.
     */
    public function update(Request $request, $id)
    {
        $batch = Batch::findOrFail($id);

        $request->merge([
            'categories' => explode(',', $request->input('categories')),
            'courses' => explode(',', $request->input('courses')),
        ]);

        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'batch_name' => 'required|string',
            'owner_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'detail_address' => 'required|string',
            'area_name' => 'required|string',
            'division' => 'required|string',
            'upazilla' => 'required|string',
            'zilla' => 'required|string',
            'union_name' => 'required|string',
            'teachers_quantity' => 'required|integer',
            'student_quantity' => 'required|integer',
            'school_name' => 'required|string',
            'teachers_comment' => 'nullable|string',
            'senior_sales_executive_comments' => 'nullable|string',
            'categories' => 'required|array',
            'categories.*' => 'required|string',
            'courses' => 'required|array',
            'courses.*' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 422);
        }

        $validated = $validator->validated();

        $batch->update($validated);

        BatchCategory::where('batch_id', $id)->delete();
        foreach ($validated['categories'] as $category) {
            BatchCategory::create(['batch_id' => $id, 'category' => $category]);
        }

        BatchCourse::where('batch_id', $id)->delete();
        foreach ($validated['courses'] as $course) {
            BatchCourse::create(['batch_id' => $id, 'course' => $course]);
        }

        $batch->load('categories', 'courses');

        return response()->json(['status' => 'success', 'message' => 'Batch data update successfully'], 200);
    }

    /**
     * Delete a batch.
     */
    public function destroy($id)
    {
        $batch = Batch::findOrFail($id);

        $batch->categories()->delete();
        $batch->courses()->delete();
        $batch->delete();

        return response()->json(['status' => 'success', 'message' => 'Batch deleted successfully'], 200);
    }
}
