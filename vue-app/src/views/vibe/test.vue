<script setup>
import { ref, computed } from 'vue';
import axios from 'axios';

const term = ref(null);
const limit = ref(null);

const locale = ref(null);
const filteredLocales = ref([]);
const locales = ref([
  { name: 'ar-AE', code: 'ar-AE' },
  { name: 'cs-CZ', code: 'cs-CZ' },
  { name: 'da-DK', code: 'da-DK' },
  { name: 'de-DE', code: 'de-DE' },
  { name: 'el-GR', code: 'el-GR' },
  { name: 'en-US', code: 'en-US' },
  { name: 'es-ES', code: 'es-ES' },
  { name: 'fi-FI', code: 'fi-FI' },
  { name: 'fr-FR', code: 'fr-FR' },
  { name: 'hu-HU', code: 'hu-HU' },
  { name: 'is-IS', code: 'is-IS' },
  { name: 'it-IT', code: 'it-IT' },
  { name: 'iw-IL', code: 'iw-IL' },
  { name: 'ja-JP', code: 'ja-JP' },
  { name: 'ko-KR', code: 'ko-KR' },
  { name: 'lt-LT', code: 'lt-LT' },
  { name: 'ms-MY', code: 'ms-MY' },
  { name: 'nl-NL', code: 'nl-NL' },
  { name: 'no-NO', code: 'no-NO' },
  { name: 'pl-PL', code: 'pl-PL' },
  { name: 'pt-BR', code: 'pt-BR' },
  { name: 'pt-PT', code: 'pt-PT' },
  { name: 'ro-RO', code: 'ro-RO' },
  { name: 'ru-RU', code: 'ru-RU' },
  { name: 'sk-SK', code: 'sk-SK' },
  { name: 'sr-RS', code: 'sr-RS' },
  { name: 'sv-SE', code: 'sv-SE' },
  { name: 'th-TH', code: 'th-TH' },
  { name: 'tr-TR', code: 'tr-TR' },
  { name: 'uk-UA', code: 'uk-UA' },
  { name: 'zh-CN', code: 'zh-CN' },
  { name: 'zh-TW', code: 'zh-TW' }
]);

const locationType = ref(null);
const filteredLocationTypes = ref([]);
const locationTypes = ref([
  { name: 'station', code: 'ar-AE' },
  { name: 'airport', code: 'airport' },
  { name: 'bus_station', code: 'bus_station' },
  { name: 'city', code: 'city' },
  { name: 'autonomous_territory', code: 'autonomous_territory' },
  { name: 'subdivision', code: 'subdivision' },
  { name: 'country', code: 'country' },
  { name: 'region', code: 'region' },
  { name: 'continent', code: 'continent' }
]);

const searchLocale = (event) => {
  setTimeout(() => {
    if (!event.query.trim().length) {
      filteredLocales.value = [...locales.value];
    } else {
      filteredLocales.value = locales.value.filter((locale) => {
        return locale.name.toLowerCase().startsWith(event.query.toLowerCase());
      });
    }
  }, 250);
};

const searchLocationType = (event) => {
  setTimeout(() => {
    if (!event.query.trim().length) {
      filteredLocationTypes.value = [...locationTypes.value];
    } else {
      filteredLocationTypes.value = locationTypes.value.filter((locationType) => {
        return locationType.name.toLowerCase().startsWith(event.query.toLowerCase());
      });
    }
  }, 250);
};

const isEmpty = (value) => {
  return value === null || value === undefined || value === '';
};

const isTermEmptyValue = computed(() => {
  return isEmpty(term.value);
});

const fetchApiData = async () => {
  fetchResult.value = null;

  if (!isTermEmptyValue.value) {
    loading.value = true;
    const payload = {};

    if (term.value) {
      payload.term = term.value;
    }

    if (locale.value) {
      payload.locale = locale.value.code;
    }

    if (locationType && locationType.value && locationType.value.length > 0) {
      payload.location_types = locationType.value.map(item => item.name);
    }

    if (limit.value) {
      payload.limit = limit.value;
    }

    try {
      const response = await axios.post('http://localhost/laravel/api/search', payload);
      fetchResult.value = response.data.locations;
      loading.value = false;
    } catch (error) {
      console.error('Error fetching data:', error);
      loading.value = false;
    }
  }
};
//-------------
let fetchResult = ref(null);
const loading = ref(null);

</script>
<template>
  <div class="grid p-fluid">
    <div class="col-12 md:col-12">
      <div class="card">
        <h5>Search</h5>
        <InputText id="term" type="text" v-model="term" :class="{ 'p-invalid': isTermEmptyValue }" />

        <h5>Locale result (default en-US)</h5>
        <AutoComplete placeholder="Search" :dropdown="true" :multiple="false" v-model="locale" :suggestions="filteredLocales" @complete="searchLocale" field="name" />

        <h5>Location types</h5>
        <AutoComplete placeholder="Search" :dropdown="true" :multiple="true" v-model="locationType" :suggestions="filteredLocationTypes" @complete="searchLocationType" field="name" />

        <h5>Number of results (default 10)</h5>
        <InputNumber v-model="limit" showButtons mode="decimal"></InputNumber>

        <h5></h5>
        <Button label="Search" class="mr-2 mb-2" @click="fetchApiData"></Button>
      </div>

      <div class="card">
        <h5>Results</h5>
        <DataTable
            :value="fetchResult"
            :paginator="true"
            class="p-datatable-gridlines"
            :rows="10"
            dataKey="id"
            :rowHover="true"
            filterDisplay="menu"
            :loading="loading"
            responsiveLayout="scroll"
        >
          <template #empty> No data found. </template>
          <template #loading> Loading data. Please wait. </template>
          <Column field="id" header="Id" style="min-width: 12rem">
            <template #body="{ data }">
              {{ data.id }}
            </template>
          </Column>

          <Column field="code" header="Code" style="min-width: 12rem">
            <template #body="{ data }">
              {{ data.code }}
            </template>
          </Column>

          <Column field="name" header="Name" style="min-width: 12rem">
            <template #body="{ data }">
              {{ data.name }}
            </template>
          </Column>

          <Column field="type" header="Type" style="min-width: 12rem">
            <template #body="{ data }">
              {{ data.type }}
            </template>
          </Column>
        </DataTable>
      </div>
    </div>

  </div>
</template>
