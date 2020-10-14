<template>
    <form  class="flex bg-white shadow-md rounded p-5" @submit.prevent="createEvent()">        
        <div class="flex flex-wrap mx-3 mb-6 w-full">
            <div class="w-full mb-6">
                <label for="" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Event Title <span class="absolute pl-1 inline text-base font-bold text-red-400">*</span></label>
                <input type="text" id="eventtitle" v-model="cevent.title" placeholder="Enter event title here" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-600 rounded py-3 px-3 mb-3 leading-tight focus:outline-none focus:bg-white">
            </div>            
            <div class="w-1/2 pr-5 mb-6">
                <label for="start_date" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">From <span class="absolute pl-1 inline text-base font-bold text-red-400">*</span></label>
                <input type="date" id="start_date" v-model="cevent.start_date" @change="createCalendar" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-600 rounded py-3 px-3 mb-3 leading-tight focus:outline-none focus:bg-white">
            </div>
            <div class="w-1/2 pl-5 mb-6">
                <label for="end_date" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">To <span class="absolute pl-1 inline text-base font-bold text-red-400">*</span></label>
                <input type="date" id="end_date" v-model="cevent.end_date" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-600 rounded py-3 px-3 mb-3 leading-tight focus:outline-none focus:bg-white">
            </div>

            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Day of The Week <span class="absolute pl-1 inline text-base font-bold text-red-400">*</span></label>
            <div class="flex w-full bg-gray-200 border rounded border-solid border-gray-600 mb-6">                
                <div class="flex-1 px-4 py-2 m-2">
                    <label for="" class="block text-gray-700">
                        <input type="checkbox" id="chksun" value="0" v-model="cevent.dow" class="mr-1 leading-tight">Sun
                    </label>
                </div>
                <div class="flex-1 px-4 py-2 m-2">
                    <label for="" class="block text-gray-700">
                        <input type="checkbox" id="chkmon" value="1" v-model="cevent.dow" class="mr-1 leading-tight">Mon
                    </label>
                </div>
                <div class="flex-1 px-4 py-2 m-2">
                    <label for="" class="block text-gray-700">
                        <input type="checkbox" id="chktue" value="2" v-model="cevent.dow" class="mr-1 leading-tight">Tue
                    </label>
                </div>
                <div class="flex-1 px-4 py-2 m-2">
                    <label for="" class="block text-gray-700">
                        <input type="checkbox" id="chkwed" value="3" v-model="cevent.dow" class="mr-1 leading-tight">Wed
                    </label>
                </div>
                <div class="flex-1 px-4 py-2 m-2">
                    <label for="" class="block text-gray-700">
                        <input type="checkbox" id="chkthur" value="4" v-model="cevent.dow" class="mr-1 leading-tight">Thur
                    </label>
                </div>
                <div class="flex-1 px-4 py-2 m-2">
                    <label for="" class="block text-gray-700">
                        <input type="checkbox" id="chkfri" value="5" v-model="cevent.dow" class="mr-1 leading-tight">Fri
                    </label>
                </div>
                <div class="flex-1 px-4 py-2 m-2">
                    <label for="" class="block text-gray-700">
                        <input type="checkbox" id="chksat" value="6" v-model="cevent.dow" class="mr-1 leading-tight">Sat
                    </label>
                </div>
            </div>            
            <div class="block">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
            </div>
        </div>
    </form>
</template>

<script>

function resetForm(formObj) {
    formObj.title = '';
    formObj.start_date = '';
    formObj.end_date = '';
    formObj.dow = [];
}

export default {
    name: 'events-form',
    data: function() {
        return {
            cevent:  {
                title: '',
                start_date: '',
                end_date: '',
                dow: []
            },
            hasError: false
        }        
    },
    beforeCreate() {
        // before component is created
    },
    created() {
        // after component is created
    },
    mounted() {
        // after component is mounted
    },
    methods: {
        createEvent() {
            var that = this;            
            axios({
                method: 'post',
                url:    '/api/events',
                data: {
                    title: that.cevent.title,
                    start_date: that.cevent.start_date,
                    end_date: that.cevent.end_date,
                    dow: that.cevent.dow,
                }
            })
            .then(function (response) {                
                // after saving the data re-create the calendar                
                that.$emit('createCalendar', that.cevent.start_date);                
                resetForm(that.cevent);
                that.$notify(
                    {
                    group: "top",
                    title: "Success",
                    text: "New Event Created!"
                    },
                    2000
                );
            });
        },
        createCalendar() {
            //check first if all required data is filled
            this.$emit('createCalendar', this.cevent.start_date);
        }
    }
}
</script>

<style>

</style>