<?php

namespace App\Http\Controllers\Customer\Profile;

use Hamcrest\Core\IsNull;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketFile;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Ticket\TicketCategory;
use App\Models\Ticket\TicketPriority;
use App\Http\Services\File\FileService;
use App\Http\Requests\Customer\Profile\StoreTicketRequest;
use App\Http\Requests\Customer\Profile\StoreAnswerTicketRequest;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = auth()->user()->tickets()->whereNull('ticket_id')->get();

        return view('customer.profile.tickets.my-tickets', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        return view('customer.profile.tickets.show-ticket', compact('ticket'));
    }


    public function change(Ticket $ticket)
    {
        $ticket->status = $ticket->status == 0 ? 1 : 1;
        $result = $ticket->save();
        return redirect()->back()->with('swal-success', ' وضعیت تیکت شما با موفقیت تغییر کرد');
    }


    public function answer(StoreAnswerTicketRequest $request, Ticket $ticket)
    {

         $inputs = $request->all();

        $inputs['subject'] = $ticket->subject;
        $inputs['description'] = $request->description;
        $inputs['reference_id'] = $ticket->reference_id;
        $inputs['category_id'] = $ticket->category_id;
        $inputs['priority_id'] = $ticket->priority_id;
        $inputs['ticket_id'] = $ticket->id;
        $inputs['user_id'] = auth()->user()->id;
        $inputs['seen'] = 0;

        $ticket = Ticket::create($inputs);
        return redirect()->route('customer.profile.my-ticket')->with('swal-success', ' پاسخ شما با موفقیت ثبت شد');
    }

    public function create(Ticket $ticket)
    {
        $ticketCategories = TicketCategory::all();
        $ticketPriorities = TicketPriority::where('status', 1)->get();
        return view('customer.profile.tickets.create', compact('ticketCategories', 'ticketPriorities'));
    }

    public function store(StoreTicketRequest $request, FileService $fileService)
    {
        DB::transaction(function () use ($request, $fileService) {

            //ticket body
            $inputs = $request->all();
            $inputs['user_id'] = auth()->user()->id;
            $ticket = Ticket::create($inputs);

            //ticket file
            if ($request->hasFile('file')) {
                $fileService->setExclusiveDirectory('files' . DIRECTORY_SEPARATOR . 'ticket-files');
                $fileService->setFileSize($request->file('file'));

                //file save path
                $fileSize = $fileService->getFileSize();
                $result = $fileService->moveToPublic($request->file('file'));
                // $result = $fileService->moveToStorage($request->file('file'));
                $fileFormat = $fileService->getFileFormat();

                $inputs['ticket_id'] = $ticket->id;
                $inputs['user_id'] =  auth()->user()->id;
                $inputs['file_path'] = $result;
                $inputs['file_size'] = $fileSize;
                $inputs['file_type'] = $fileFormat;

                $file = TicketFile::create($inputs);
            }
        });
        return to_route('customer.profile.my-ticket')->with('swal-success', ' تیکت شما با موفقیت ثبت شد');
    }
}
