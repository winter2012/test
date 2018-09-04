#include <stdio.h>
#include <stdlib.h>
int main(){
	int a,b,c,d;
	scanf("%d,%d,%d,%d",&a,&b,&c,&d);
	int max(int x,int y);
	int MaxOfThree(int a,int b,int c);
	int min(int x,int y);
	int MinOfThree(int a,int b,int c);
	int maxNum = max(MaxOfThree(a,b,c),d);
	int minNum = min(MinOfThree(a,b,c),d);
	printf("最大数是%d\n最小数是%d\n",maxNum,minNum);
	system("pause");
	return d;
}

int MaxOfThree(int a,int b,int c){
	int max(int x,int y);
	int d = max(a,b);
	int e = max(d,c);
	return e;
}

int MinOfThree(int a,int b,int c){
	int min(int x,int y);
	int d = min(a,b);
	int e = min(d,c);
	return e;
}

int max(int x,int y){
	int max;
	if(x > y){
		max = x;
	} else {
		max = y;
	}
	return max;
}

int min(int x,int y){
	int min;
	if(x < y){
		min = x;
	} else {
		min = y;
	}
	return min;
}
