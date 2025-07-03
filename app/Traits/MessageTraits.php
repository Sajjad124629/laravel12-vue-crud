<?php
namespace App\Traits;

use Redirect;

trait MessageTraits
{
    public function success($message, $to = null)
    {
        $notify = [
            'message' => $message,
            'description' => 'Good Job!',
            'alert-type' => 'success',
        ];
        return redirect($to)->with($notify);
    }
    public function successRedirect($message, $to = null)
    {
        if (is_null($to)) {
            $to = route('root');
        }
        $notify = [
            'message' => $message,
            'description' => 'Success!',
            'alert-type' => 'success',
        ];
        return redirect($to)->with($notify);
    }

    public function error($message)
    {
        $notify = [
            'message' => $message,
            'description' => 'Error!',
            'alert-type' => 'error',
        ];
        return Redirect::back()->with($notify);
    }
    public function errorRedirect($message, $to = null)
    {
        if (is_null($to)) {
            $to = route('root');
        }
        $notify = [
            'message' => $message,
            'description' => 'Oops!',
            'alert-type' => 'error',
        ];
        return redirect($to)->with($notify);
    }
    public function warningRedirect($message, $to = null)
    {
        if (is_null($to)) {
            $to = route('root');
        }
        $notify = [
            'message' => $message,
            'description' => 'Warning!',
            'alert-type' => 'warning',
        ];
        return redirect($to)->with($notify);
    }

    public function validationError($message)
    {
        $notify = [
            'message' => $message,
            'description' => 'Validation failed!',
            'alert-type' => 'error',
        ];
        
        return back()->with($notify);
    }
    
}
