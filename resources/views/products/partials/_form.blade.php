<x-input :col="'12'" :mb="'3'" :default="$product->name ?? ''" :field="'name'" :label="__('Name')" />
<x-input :col="'12'" :mb="'3'" :default="$product->description ?? ''" :field="'description'" :label="__('Description')" />
<x-input :col="'12'" :mb="'3'" :default="$product->price ?? ''" :field="'price'" :label="__('Price')"
    :type="'number'" :step="0.01" />
<x-input :col="'12'" :mb="'3'" :field="'cover'" :label="__('Cover')" :type="'file'"
    :required="false" />
<x-select-input :col="'12'" :mb="'3'" :selected="$product->recurrent ?? ''" :selected="1" :options="[0 => __('No'), 1 => __('Yes')]"
    :field="'recurrent'" :label="__('Recurrent')" />
<x-select-input :col="'12'" :mb="'3'" :selected="$product->period ?? ''" :options="App\Enums\PaymentRecurrencePeriodEnum::toSelectInput()" :field="'period'"
    :label="__('Period')" />
