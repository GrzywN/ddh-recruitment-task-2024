<?php

namespace App\Http\Controllers;

use App\Services\Forms\Form;
use App\Services\Forms\FormBuilder;
use App\Services\Forms\Validators\EmailValidator;
use App\Services\Forms\Validators\MaxLengthValidator;
use App\Services\Forms\Validators\MinLengthValidator;
use App\Services\Forms\Validators\RequiredValidator;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactFormController extends Controller
{
    private readonly Form $form;

    private const string FIRST_NAME_DISPLAY_NAME = 'imię';

    private const string EMAIL_DISPLAY_NAME = 'email';

    private const string DESCRIPTION_DISPLAY_NAME = 'opis';

    private const int FIRST_NAME_MIN_LENGTH = 3;

    private const int FIRST_NAME_MAX_LENGTH = 50;

    private const int DESCRIPTION_MAX_LENGTH = 500;

    public function __construct()
    {
        $this->form = (new FormBuilder('/'))
            ->addTextField(
                name: 'first_name',
                required: true,
                validators: [
                    new RequiredValidator(self::FIRST_NAME_DISPLAY_NAME),
                    new MinLengthValidator(self::FIRST_NAME_DISPLAY_NAME, self::FIRST_NAME_MIN_LENGTH),
                    new MaxLengthValidator(self::FIRST_NAME_DISPLAY_NAME, self::FIRST_NAME_MAX_LENGTH),
                ],
                placeholder: 'Wpisz swoje imię',
            )
            ->addEmailField(
                name: 'email',
                required: true,
                validators: [
                    new RequiredValidator(self::EMAIL_DISPLAY_NAME),
                    new EmailValidator(self::EMAIL_DISPLAY_NAME),
                ],
                placeholder: 'Wpisz swój adres email',
            )
            ->addTextareaField(
                name: 'description',
                required: false,
                validators: [
                    new MaxLengthValidator(self::DESCRIPTION_DISPLAY_NAME, self::DESCRIPTION_MAX_LENGTH),
                ],
                placeholder: 'Wpisz opis',
            )
            ->build();
    }

    public function show(): View
    {
        return view('contact-form', ['form' => $this->form->render()]);
    }

    public function store(Request $request): View|RedirectResponse
    {
        $data = $request->all();

        $isValid = $this->form->validate($data);

        if ($isValid) {
            // TODO: Store data

            return to_route('contact-form.success');
        }

        $this->form->setPreviousValues($data);

        return view('contact-form', ['form' => $this->form->render()]);
    }

    public function success(): View
    {
        return view('contact-form-success');
    }
}
