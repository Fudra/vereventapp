/* eslint-disable */
export default {
	data() {
		return {
			local: {
				dow: 1, // Monday is the first day of the week
				hourTip: this.$t('local.date.hourTip'), // tip of select hour
				minuteTip: this.$t('local.date.minuteTip'), // tip of select minute
				secondTip: this.$t('local.date.secondTip'), // tip of select second
				yearSuffix: this.$t('local.date.yearSuffix'), // format of head
				monthsHead: this.$t('local.date.monthsHead').split('_'), // months of head
				months: this.$t('local.date.months').split('_'), // months of panel
				weeks: this.$t('local.date.weeks').split('_') // weeks
			}
		}
	}
};