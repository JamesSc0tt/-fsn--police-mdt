<?php 
	$jsun = '
		[
			{
				"name": "Black",
				"hex": "#080808",
				"r": 8,
				"g": 8,
				"b": 8
			},
			{
				"name": "Graphite",
				"hex": "#0F0F0F",
				"r": 15,
				"g": 15,
				"b": 15
			},
		]
	';
?>

<!-- 

0,Black,#080808,8,8,8
1,Graphite,#0F0F0F,15,15,15
2,Black Steel,#1C1E21,28,30,33
3,Dark Steel,#292C2E,41,44,46
4,Silver,#5A5E66,90,94,102
5,Bluish Silver,#777C87,119,124,135
6,Rolled Steel,#515459,81,84,89
7,Shadow Silver,#323B47,50,59,71
8,Stone Silver,#333333,51,51,51
9,Midnight Silver,#1F2226,31,34,38
10,Cast Iron Silver,#23292E,35,41,46
11,Anthracite Black,#121110,18,17,16
12,Matte Black,#050505,5,5,5
13,Matte Gray,#121212,18,18,18
14,Matte Light Gray,#2F3233,47,50,51
15,Util Black,#080808,8,8,8
16,Util Black Poly,#121212,18,18,18
17,Util Dark silver,#202224,32,34,36
18,Util Silver,#575961,87,89,97
19,Util Gun Metal,#23292E,35,41,46
20,Util Shadow Silver,#323B47,50,59,71
21,Worn Black,#0F1012,15,16,18
22,Worn Graphite,#212121,33,33,33
23,Worn Silver Grey,#5B5D5E,91,93,94
24,Worn Silver,#888A99,136,138,153
25,Worn Blue Silver,#697187,105,113,135
26,Worn Shadow Silver,#3B4654,59,70,84
27,Red,#690000,105,0,0
28,Torino Red,#8A0B00,138,11,0
29,Formula Red,#6B0000,107,0,0
30,Blaze Red,#611009,97,16,9
31,Grace Red,#4A0A0A,74,10,10
32,Garnet Red,#470E0E,71,14,14
33,Sunset Red,#380C00,56,12,0
34,Cabernet Red,#26030B,38,3,11
35,Candy Red,#630012,99,0,18
36,Sunrise Orange,#802800,128,40,0
37,Gold,#6E4F2D,110,79,45
38,Orange,#BD4800,189,72,0
39,Matte Red,#780000,120,0,0
40,Matte Dark Red,#360000,54,0,0
41,Matte Orange,#AB3F00,171,63,0
42,Matte Yellow,#DE7E00,222,126,0
43,Util Red,#520000,82,0,0
44,Util Bright Red,#8C0404,140,4,4
45,Util Garnet Red,#4A1000,74,16,0
46,Worn Red,#592525,89,37,37
47,Worn Golden Red,#754231,117,66,49
48,Worn Dark Red,#210804,33,8,4
49,Dark Green,#001207,0,18,7
50,Racing Green,#001A0B,0,26,11
51,Sea Green,#00211E,0,33,30
52,Olive Green,#1F261E,31,38,30
53,Bright Green,#003805,0,56,5
54,Gasoline Green,#0B4145,11,65,69
55,Matte Lime Green,#418503,65,133,3
56,Util Dark Green,#0F1F15,15,31,21
57,Util Green,#023613,2,54,19
58,Worn Dark Green,#162419,22,36,25
59,Worn Green,#2A3625,42,54,37
60,Worn Sea Wash,#455C56,69,92,86
61,Galaxy Blue,#000D14,0,13,20
62,Dark Blue,#001029,0,16,41
63,Saxon Blue,#1C2F4F,28,47,79
64,Blue,#001B57,0,27,87
65,Mariner Blue,#3B4E78,59,78,120
66,Harbor Blue,#272D3B,39,45,59
67,Diamond Blue,#95B2DB,149,178,219
68,Surf Blue,#3E627A,62,98,122
69,Nautical Blue,#1C3140,28,49,64
70,Ultra Blue,#0055C4,0,85,196
71,Schafter Purple,#1A182E,26,24,46
72,Spinnaker Purple,#161629,22,22,41
73,Racing Blue,#0E316D,14,49,109
74,Light Blue,#395A83,57,90,131
75,Util Dark Blue,#09142E,9,20,46
76,Util Midnight Blue,#0F1021,15,16,33
77,Util Blue,#152A52,21,42,82
78,Util Sea Foam Blue,#324654,50,70,84
79,Util Lightning Blue,#152563,21,37,99
80,Util Maui Blue Poly,#223BA1,34,59,161
81,Util Bright Blue/Slate Blue,#1F1FA1,31,31,161
82,Matte Dark Blue,#030E2E,3,14,46
83,Matte Blue,#0F1E73,15,30,115
84,Matte Midnight Blue,#001C32,0,28,50
85,Worn Dark Blue,#2A3754,42,55,84
86,Worn Blue,#303C5E,48,60,94
87,Worn Baby Blue,#3B6796,59,103,150
88,Yellow,#F5890F,245,137,15
89,Race Yellow,#D9A600,217,166,0
90,Bronze,#4A341B,74,52,27
91,Dew Yellow/Yellow Bird,#A2A827,162,168,39
92,Lime Green,#568F00,86,143,0
93,Champagne,#57514B,87,81,75
94,Feltzer Brown,#291B06,41,27,6
95,Creek Brown,#262117,38,33,23
96,Chocolate Brown,#120D07,18,13,7
97,Maple Brown,#332111,51,33,17
98,Saddle Brown,#3D3023,61,48,35
99,Straw Brown,#5E5343,94,83,67
100,Moss Brown,#37382B,55,56,43
101,Bison Brown,#221918,34,25,24
102,WoodBeech Brown,#575036,87,80,54
103,BeechWood Brown,#241309,36,19,9
104,Sienna Brown,#3B1700,59,23,0
105,Sandy Brown,#6E6246,110,98,70
106,Bleached Brown,#998D73,153,141,115
107,Cream,#CFC0A5,207,192,165
108,Util Brown,#1F1709,31,23,9
109,Util Medium Brown,#3D311D,61,49,29
110,Util Light Brown,#665847,102,88,71
111,Ice White,#F0F0F0,240,240,240
112,Frost White,#B3B9C9,179,185,201
113,Worn Honey Beige,#615F55,97,95,85
114,Worn Brown,#241E1A,36,30,26
115,Worn Dark Brown,#171413,23,20,19
116,Worn Straw Beige,#3B372F,59,55,47
117,Brushed Steel,#3B4045,59,64,69
118,Brushed Black Steel,#1A1E21,26,30,33
119,Brushed Aluminium,#5E646B,94,100,107
120,Chrome,#000000,0,0,0
121,Worn Off White,#B0B0B0,176,176,176
122,Util Off White,#999999,153,153,153
123,Worn Orange,#B56519,181,101,25
124,Worn Light Orange,#C45C33,196,92,51
125,Pea Green/Securicor Green,#47783C,71,120,60
126,Worn Taxi Yellow,#BA8425,186,132,37
127,Police Blue,#2A77A1,42,119,161
128,Matte Green,#243022,36,48,34
129,Matte Brown,#6B5F54,107,95,84
130,Worn Orange 2,#C96E34,201,110,52
131,Ice White Matte,#D9D9D9,217,217,217
132,Worn White,#F0F0F0,240,240,240
133,Worn Olive Army Green,#3F4228,63,66,40
134,Pure White,#FFFFFF,255,255,255
135,Hot Pink,#B01259,176,18,89
136,Salmon Pink,#F69799,246,151,153
137,Pfister Pink,#8F2F55,143,47,85
138,Bright Orange,#C26610,194,102,16
139,Green Bright,#69BD45,105,189,69
140,Fluorescent Blue,#00AEEF,0,174,239
141,Midnight Blue,#000108,0,1,8
142,Midnight Purple,#050008,5,0,8
143,Wine Red,#080000,8,0,0
144,Hunter Green,#565751,86,87,81
145,Bright Purple,#320642,50,6,66
146,Midnight Purple / V Dark Blue,#050008,5,0,8
147,Carbon Black,#080808,8,8,8
148,Matte Schafter Purple,#320642,50,6,66
149,Matte Midnight Purple,#050008,5,0,8
150,Lava Red,#6B0B00,107,11,0
151,Matte Forest Green,#121710,18,23,16
152,Matte Olive Drab,#323325,50,51,37
153,Matte Dark Earth,#3B352D,59,53,45
154,Matte Desert Tan,#706656,112,102,86
155,Matte Foliage Green,#2B302B,43,48,43
156,DefaultAlloyColor,#414347,65,67,71
157,Epsilon Blue,#6690B5,102,144,181
158,Pure Gold,#47391B,71,57,27
159,Brushed Gold,#47391B,71,57,27
160,MP100,#FFD859,255,216,89

-->