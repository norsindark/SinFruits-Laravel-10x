<tr class="view-items-row text-center" style="display: none;" id="view-options-{{ $item->id }}">
    <td colspan="6">
        <table class="table align-items-center mb-0">
            <thead>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                    ID Report
                </th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Cancel Reason
                </th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        {{ $item->id}}
                    </td>
                    <td class="text-center">
                        {{ $item->cancel_reason }}
                    </td>

                </tr>
            </tbody>
        </table>
    </td>
</tr>
