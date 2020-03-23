<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Country;
use App\Gender;
use App\Http\Requests\CreateDoctorPost;
use App\Http\Requests\SendNotificationPost;
use App\Notifications\AppointmentArranged;
use App\Notifications\AppointmentResponded;
use App\Pain;
use App\User;
use App\Http\Requests\SavePersonalDataPost;
use App\Specialty;
use Illuminate\Http\Request;
use Notification;
use Illuminate\Support\Facades\Hash;

class CpanelController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['genders'] = Gender::all() ;
        $data['countries'] = Country::all() ;
        $data['pains'] = Pain::all() ;
        $data['specialties'] =  Specialty::all();
        $data['currentUser'] = auth()->user();
        return view('cpanel.index',$data);
    }

    public function savePersonalData(SavePersonalDataPost $request,$id)
    {
        $validated = $request->validated();
        $user = User::find($id);
        $user->update($validated);
        return redirect()->back()->with('success','your profile is updated');
    }

    public function addDoctor()
    {
        $data['specialties'] =  Specialty::all();
       return view('cpanel.addDoctor',$data);
    }

    public function createDoctor(CreateDoctorPost $request)
    {
        $validated = $request->validated();
         User::create([
            'username' => $validated['username'],
            'role_id'  => 2,
            'password' => Hash::make($validated['password']),
             'specialty_id' => $validated['specialty'],
        ]);
        return redirect()->back()->with('success',__('Doctor is Added successfully'));
    }

    public function sendNotification()
    {
        $data['patients'] = User::whereNotNull('pain_id')->get();
        $data['doctors'] = User::where('role_id','=','2')->get();
        return view('cpanel.sendNotification',$data);
    }

    public function sendNotificationPost(SendNotificationPost $request)
    {
        $validated = $request->validated();
        $appointment = Appointment::where('patient_id', '=', $validated['patient_id'])->first();
        $doctor = User::find($validated['doctor_id']) ;
        $patient = User::find($validated['patient_id']) ;
        if ($appointment != null) {
            if($appointment->exists())
            {
                $existed = Appointment::find($appointment->id);
                $existed->date = $validated['date'];
                $existed->save();
                Notification::send($doctor,new AppointmentArranged(
                    [
                        'Greeting' => 'Hi Dr.'.$doctor->username,
                        'body' => 'The Appointment is on '.$validated['date'].' with Mr.'.$patient->username.' you can accept or ignore '
                    ]
                ));
                Notification::send($patient,new AppointmentArranged(
                    [
                        'Greeting' => 'Hi Mr.'.$patient->username,
                        'body' => 'The Appointment is on '.$validated['date'].' with Dr.'.$doctor->username.' you can accept or ignore '
                    ]
                ));
            }
        }else{
            Appointment::create($validated);
            Notification::send($doctor,new AppointmentArranged(
                [
                    'Greeting' => 'Hi Dr.'.$doctor->username,
                    'body' => 'The Appointment is on '.$validated['date'].' with Mr.'.$patient->username.' you can accept or ignore '
                ]
            ));
            Notification::send($patient,new AppointmentArranged(
                [
                    'Greeting' => 'Hi Mr.'.$patient->username,
                    'body' => 'The Appointment is on '.$validated['date'].' with Dr.'.$doctor->username.' you can accept or ignore '
                ]
            ));
        }


        return redirect()->back()->with('success','Notification Has Been Sent To Doctor And Patient');
    }

    public function notifications()
    {
        return view('cpanel.notifications');
    }

    public function notificationsPost(Request $request)
    {
        $currentUser= auth()->user();
        if ($request->submit == 'yes')
            $accept = 'accepted';
        else
            $accept = 'refused';


            if($currentUser->role_id == 3)
            {
                $notification = $currentUser->notifications->where('id',$request->notification_id)->first();
                $notification->markAsRead();
                $date = Appointment::where('patient_id','=',$currentUser->id)->first()->date;
                Notification::send(User::find(1),new AppointmentResponded(
                    [
                        'Greeting' => 'Hi Admin',
                        'body' => 'The Appointment  has been '.$accept.' form Mr.'.$currentUser->username.' on '.$date
                    ]
                ));
            }
            if($currentUser->role_id == 2)
            {
                $notification = $currentUser->notifications->where('id',$request->notification_id)->first();
                $notification->markAsRead();
                Notification::send(User::find(1),new AppointmentResponded(
                    [
                        'Greeting' => 'Hi Admin',
                        'body' => 'The Appointment  has been '.$accept.' form Dr.'.$currentUser->username
                    ]
                ));
            }
        return redirect()->route('index');

    }

    public function adminNotifications()
    {

        return view('cpanel.adminNotification');
    }
}
