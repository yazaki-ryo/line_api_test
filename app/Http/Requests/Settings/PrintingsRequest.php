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
        $i = $this->segment(4);
        if (! is_numeric($i)) {
            throw new \InvalidArgumentException('The transmitted setting ID is invalid.');
        }

        return [
            sprintf('name_%s', $i) => [
                'required',
                'string',
                'max:191',
            ],

            /**
             * Postalcode
             */
            sprintf('pc_position_%s', $i) => [
                'required',
                'string',
                'max:191',
                Rule::in(array_keys(config('pdf.positions'))),
            ],
            sprintf('pc_frame_%s', $i) => [
                'required',
                'boolean',
            ],
            sprintf('pc_symbol_%s', $i) => [
                'required',
                'boolean',
            ],
            sprintf('pc_x_%s', $i) => [
                'required',
                'numeric',
                'max:999',
            ],
            sprintf('pc_y_%s', $i) => [
                'required',
                'numeric',
                'max:999',
            ],
            sprintf('pc_font_%s', $i) => [
                'required',
                'string',
                'max:191',
                Rule::in(array_keys(config('pdf.fonttypes'))),
            ],
            sprintf('pc_font_size_%s', $i) => [
                'required',
                'string',
                'max:191',
                Rule::in(array_keys(config('pdf.fontsizes'))),
            ],

            /**
             * Address
             */
            sprintf('address_x_%s', $i) => [
                'required',
                'numeric',
                'max:999',
            ],
            sprintf('address_y_%s', $i) => [
                'required',
                'numeric',
                'max:999',
            ],
            sprintf('address_font_%s', $i) => [
                'required',
                'string',
                'max:191',
                Rule::in(array_keys(config('pdf.fonttypes'))),
            ],
            sprintf('address_font_size_%s', $i) => [
                'required',
                'string',
                'max:191',
                Rule::in(array_keys(config('pdf.fontsizes'))),
            ],

            /**
             * Name
             */
            sprintf('name_x_%s', $i) => [
                'required',
                'numeric',
                'max:999',
            ],
            sprintf('name_y_%s', $i) => [
                'required',
                'numeric',
                'max:999',
            ],
            sprintf('name_font_%s', $i) => [
                'required',
                'string',
                'max:191',
                Rule::in(array_keys(config('pdf.fonttypes'))),
            ],
            sprintf('name_font_size_%s', $i) => [
                'required',
                'string',
                'max:191',
                Rule::in(array_keys(config('pdf.fontsizes'))),
            ],

            /**
             * Senders
             */
            sprintf('sender_flag_%s', $i) => [
                'required',
                'boolean',
            ],

            /**
             * Sender postalcode
             */
            sprintf('pc_symbol_%s', $i) => [
                'required',
                'boolean',
            ],
            sprintf('sender_pc_x_%s', $i) => [
                'required',
                'numeric',
                'max:999',
            ],
            sprintf('sender_pc_y_%s', $i) => [
                'required',
                'numeric',
                'max:999',
            ],
            sprintf('sender_pc_font_%s', $i) => [
                'required',
                'string',
                'max:191',
                Rule::in(array_keys(config('pdf.fonttypes'))),
            ],
            sprintf('sender_pc_font_size_%s', $i) => [
                'required',
                'string',
                'max:191',
                Rule::in(array_keys(config('pdf.fontsizes'))),
            ],

            /**
             * Sender address
             */
            sprintf('sender_address_x_%s', $i) => [
                'required',
                'numeric',
                'max:999',
            ],
            sprintf('sender_address_y_%s', $i) => [
                'required',
                'numeric',
                'max:999',
            ],
            sprintf('sender_address_font_%s', $i) => [
                'required',
                'string',
                'max:191',
                Rule::in(array_keys(config('pdf.fonttypes'))),
            ],
            sprintf('sender_address_font_size_%s', $i) => [
                'required',
                'string',
                'max:191',
                Rule::in(array_keys(config('pdf.fontsizes'))),
            ],

            /**
             * Sender name
             */
            sprintf('sender_name_x_%s', $i) => [
                'required',
                'numeric',
                'max:999',
            ],
            sprintf('sender_name_y_%s', $i) => [
                'required',
                'numeric',
                'max:999',
            ],
            sprintf('sender_name_font_%s', $i) => [
                'required',
                'string',
                'max:191',
                Rule::in(array_keys(config('pdf.fonttypes'))),
            ],
            sprintf('sender_name_font_size_%s', $i) => [
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
        $attributes = [];
        for ($i = 3; $i > 0; $i--) {
            foreach (\Lang::get('attributes.settings.printings') as $key => $attribute) {
                $attributes[sprintf('%s_%s', $key, $i)] = $attribute;
            }
        }

        return $attributes;
    }
}
