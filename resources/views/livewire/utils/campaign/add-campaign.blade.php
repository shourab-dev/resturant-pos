<div>
    <div class="input-style-1">
        <input type="text" placeholder="Campaign Name" />
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="input-style-1">
                <label for="start">
                    Start Date
                    <input type="datetime-local" placeholder="Campaign Name" id="start" />
                </label>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="input-style-1">
                <label for="end">
                    End Date
                    <input type="datetime-local" placeholder="Campaign Name" id="end" />
                </label>
            </div>
        </div>
    </div>
    <div x-data="{campaignType: 'fixed'}" >
        <div class="select-style-1">
            <label for="campaignType">Campaign Type</label>
            <div class="select-position" id="campaignType" >
                <select x-on:change="campaignType = $event.target.value;console.log(campaignType)">
                    <option selected value="fixed">Fixed Discount</option>
                    <option value="percentage">Percentage Discount</option>
                    <option value="buyToFree">Buy of Get Free</option>
                </select>
            </div>
        </div>
        <div class="input-style-1" x-show="campaignType == 'fixed'" >
            <input type="text" placeholder="Discount Amount" />
        </div>
        <div class="input-style-1"  x-show="campaignType == 'percentage'" >
            <input type="text" placeholder="Discount Percentage" />
        </div>
        <div class="input-style-1"  x-show="campaignType == 'buyToFree'" >
            <input type="text" placeholder="Get Free Amount" placeholder="Get 1 free"/>
        </div>
    </div>

    
</div>
