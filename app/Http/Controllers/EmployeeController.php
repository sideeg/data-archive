<?php

namespace App\Http\Controllers;

use App\Job;
use App\Employee;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:employee');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $employees = Employee::paginate(10);

        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jobs = Job::all();

        return view('employees.create', compact('jobs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validator($request->all())->validate();
        $employee = Employee::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'phone' => $request['phone'],
            'identification_number' => $request['identification_number'],
            'job_id' => $request['job_id'],
        ]);

        if ($employee->job_id == 1) {
            $this->adminRole($employee);
        }

        if ($employee->job_id == 2) {
            $this->medicineSupervisorRole($employee);
        }

        if ($employee->job_id == 3) {
            $this->deliverySupervisorRole($employee);
        }

        if ($employee->job_id == 4) {
            $this->callCenterRole($employee);
        }

        Session::flash('success', 'this employee successfully saved!');
            
        return view('employees.show', compact('employee'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $jobs = Job::all();

        return view('employees.edit', compact('employee','jobs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $this->validator($request->all())->validate();
        $employee->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'phone' => $request['phone'],
            'identification_number' => $request['identification_number'],
            'job_id' => $request['job_id'],
        ]);

        // $request->validate([
        //     'name'                  => ['required','string','min:3'],
        //     'phone'                 => ['required','integer', 'min:8'],
        //     'identification_number' => ['required','integer','min:3'],
        //     'job_id'                => ['required','integer'],
        //     'email' => 'nullable'
        // ]);

        // $employee->update($request->all());
        
        if ($employee->job_id == 1) {
            $this->adminRole($employee);
        }

        if ($employee->job_id == 2) {
            $this->medicineSupervisorRole($employee);
        }

        if ($employee->job_id == 3) {
            $this->deliverySupervisorRole($employee);
        }

        if ($employee->job_id == 4) {
            $this->callCenterRole($employee);
        }

        Session::flash('success', ' This employee successfully updated!');

        return view('employees.show', compact('employee'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {

        $employee->delete();

        Session::flash('delete','This employee Was successfully deleted');

        return redirect()->route('employees.index');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'phone' => ['nullable'],
            'identification_number' => ['required','integer','min:3'],
            'job_id'                => ['required','integer'],
        
        ]);
    }

    protected function adminRole($employee)
    {
        $role = Role::findById(1);
        $permission = Permission::findById(1);
        $employee->givePermissionTo($permission);
        $employee->assignRole($role);
    }

    protected function medicineSupervisorRole($employee)
    {
        $role = Role::findById(2);
        $permission = Permission::findById(2);
        $employee->givePermissionTo($permission);
        $employee->assignRole($role);
    }

    protected function deliverySupervisorRole($employee)
    {
        $role = Role::findById(3);
        $permission = Permission::findById(3);
        $employee->givePermissionTo($permission);
        $employee->assignRole($role);
    }

    protected function callCenterRole($employee)
    {
        $role = Role::findById(4);
        $permission = Permission::findById(4);
        $employee->givePermissionTo($permission);
        $employee->assignRole($role);
    }
}
