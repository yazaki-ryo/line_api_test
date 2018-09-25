<?php
declare(strict_types=1);

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PrintingsRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:191',
            ],

            /**
             * Postalcode
             */
            'pc_position' => [
                'required',
                'string',
                'max:191',
                Rule::in(array_keys(config('pdf.positions'))),
            ],
            'pc_frame' => [
                'required',
                'boolean',
            ],
            'pc_symbol' => [
                'required',
                'boolean',
            ],
            'pc_x' => [
                'required',
                'numeric',
                'max:999',
            ],
            'pc_y' => [
                'required',
                'numeric',
                'max:999',
            ],
            'pc_font' => [
                'required',
                'string',
                'max:191',
                Rule::in(array_keys(config('pdf.fonttypes'))),
            ],
            'pc_font_size' => [
                'required',
                'string',
                'max:191',
                Rule::in(array_keys(config('pdf.fontsizes'))),
            ],

            /**
             * Address
             */
            'address_x' => [
                'required',
                'numeric',
                'max:999',
            ],
            'address_y' => [
                'required',
                'numeric',
                'max:999',
            ],
            'address_font' => [
                'required',
                'string',
                'max:191',
                Rule::in(array_keys(config('pdf.fonttypes'))),
            ],
            'address_font_size' => [
                'required',
                'string',
                'max:191',
                Rule::in(array_keys(config('pdf.fontsizes'))),
            ],

            /**
             * Name
             */
            'name_x' => [
                'required',
                'numeric',
                'max:999',
            ],
            'name_y' => [
                'required',
                'numeric',
                'max:999',
            ],
            'name_font' => [
                'required',
                'string',
                'max:191',
                Rule::in(array_keys(config('pdf.fonttypes'))),
            ],
            'name_font_size' => [
                'required',
                'string',
                'max:191',
                Rule::in(array_keys(config('pdf.fontsizes'))),
            ],

            /**
             * Senders
             */
            'from_flag' => [
                'required',
                'boolean',
            ],

            /**
             * Sender postalcode
             */
            'from_pc_symbol' => [
                'required',
                'boolean',
            ],
            'from_pc_x' => [
                'required',
                'numeric',
                'max:999',
            ],
            'from_pc_y' => [
                'required',
                'numeric',
                'max:999',
            ],
            'from_pc_font' => [
                'required',
                'string',
                'max:191',
                Rule::in(array_keys(config('pdf.fonttypes'))),
            ],
            'from_pc_font_size' => [
                'required',
                'string',
                'max:191',
                Rule::in(array_keys(config('pdf.fontsizes'))),
            ],

            /**
             * Sender address
             */
            'from_address_x' => [
                'required',
                'numeric',
                'max:999',
            ],
            'from_address_y' => [
                'required',
                'numeric',
                'max:999',
            ],
            'from_address_font' => [
                'required',
                'string',
                'max:191',
                Rule::in(array_keys(config('pdf.fonttypes'))),
            ],
            'from_address_font_size' => [
                'required',
                'string',
                'max:191',
                Rule::in(array_keys(config('pdf.fontsizes'))),
            ],

            /**
             * Sender name
             */
            'from_name_x' => [
                'required',
                'numeric',
                'max:999',
            ],
            'from_name_y' => [
                'required',
                'numeric',
                'max:999',
            ],
            'from_name_font' => [
                'required',
                'string',
                'max:191',
                Rule::in(array_keys(config('pdf.fonttypes'))),
            ],
            'from_name_font_size' => [
                'required',
                'string',
                'max:191',
                Rule::in(array_keys(config('pdf.fontsizes'))),
            ],
        ];
    }

    /**
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Http\FormRequest::messages()
     * @return array
     */
    public function messages(): array
    {
        return [
            //
        ];
    }

    /**
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Http\FormRequest::attributes()
     * @return array
     */
    public function attributes(): array
    {
        return \Lang::get('attributes.settings.printings');
    }

    /**
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator): void
    {
        $this->errorBag = sprintf('setting_%s', $this->segment(3));
    }
}
