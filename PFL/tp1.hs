{- Exercise 1.1 Pratical sheet 1 -}

testaTriangulo :: Float -> Float -> Float -> Bool 
testaTriangulo a b c
    | a >= b + c = False 
    | b >= c + a = False 
    | c >= a + b = False 
    | otherwise = True

{- Exercise 1.2 Pratical sheet 1 -}

areaTriangulo :: Float -> Float -> Float -> Float 
areaTriangulo a b c = sqrt (s*(s-a)*(s-b)*(s-c))
    where s = (a+b+c)/2


{- Exercise 1.3 Pratical sheet 1 -}

metades :: [a] -> ([a],[a])
metades x = (take l x, drop l x)
    where l = length x `div` 2

metades' :: [a] -> ([a],[a])
metades' x = splitAt l x
    where l = length x `div` 2

{- Exercise 1.4 a) Pratical sheet 1 -}

last' :: [a] -> a
last' x =  head (take 1 (reverse x)) 

last'' :: [a] -> a
last'' x = let l = length x - 1 in head (drop l x) 

{- Exercise 1.4 b) Pratical sheet 1 -}

init' :: [a] -> [a]
init' x = reverse (tail (reverse x))

init'' :: [a] -> [a]
init'' x = reverse (drop 1 (reverse x))

{- Exercise 1.5 a) Pratical sheet 1 -}

binom :: Integer -> Integer -> Integer 
binom a b = product [1..a] `div`  (product[1..b] * product[1..(a-b)] )

{- Exercise 1.5 b) Pratical sheet 1 -}

binom2 :: Integer -> Integer -> Integer
binom2 a b
    | b < a - b = product[1..(a-b+1)] `div` product[1..b]
    | otherwise = product[b+1..a] `div` product[1..(a-b)]

{- Exercise 1.6 1) Pratical sheet 1 -}

raizes :: Float -> Float -> Float -> (Float, Float)
raizes a b c = ((-b + inside) / (2*a), (-b - inside) / (2*a))
    where inside = sqrt (b**2 - 4*a*c)

{- Exercise 1.7 Pratical sheet 1 -}

-- [Char]
-- (Char, Char, Char)
-- [(Bool,Char)]
-- ([Bool],[Char])
-- ([a] -> [a])
-- (Bool -> Bool)

{- Exercise 1.8 Pratical sheet 1 -}

-- [a] -> a
-- (a,b) -> (b,a)
-- a -> b -> (a,b)
-- Num a => a -> a
-- Fractional a => a -> a
-- Char -> Bool
-- Ord a => a -> a -> Bool
-- Eq => [a] -> Bool
-- (a -> a) -> a -> a

{- Exercise 1.9 Pratical sheet 1 -}

classifica :: Int -> String 
classifica n 
    | n >= 0 && n <= 9 = "Reprovado"
    | n > 9 && n <= 12 = "Suficiente"
    | n > 12 && n <= 15 = "Bom"
    | n > 15 && n <= 18 = "Muito Bom"
    | n > 18 && n == 20 = "Muit bom com distinção"
    | otherwise = "Nota not with the range of evaluation"

{- Exercise 1.10 Pratical sheet 1 -}

imc :: Float -> Float -> String 
imc a b
    | calc >= 0 && calc < 18.5 = "Baixo peso"
    | calc >= 18.5 && calc < 25 = "Peso normal"
    | calc >= 25 && calc < 30 = "Excesso de peso"
    | calc >= 30 = "Tas fodido filho"
    | otherwise = "Tas todo cego filho menos de 0"
    where calc = (/) a (b**2)

{- Exercise 1.11 a) Pratical sheet 1 -}

max3 :: Ord a => a -> a -> a -> a 
max3 a b c
    | a >= b && a >= c = a 
    | b >= a && b >= c = b
    | c >= a && c >= b = c


min3 :: Ord a => a -> a -> a -> a
min3 a b c
    |  a <= b && a <= c = a 
    |  b <= a && b <= c = b
    |  c <= a && c <= b = c

{- Exercise 1.11 b) Pratical sheet 1 -}

max3' :: Ord a => a -> a -> a -> a 
max3' a b c = max c m
    where m = max a b

min3' :: Ord a => a -> a -> a -> a 
min3' a b c = min c m
    where m = min a b

{- Exercise 1.12 Pratical sheet 1 -}

xor :: Bool -> Bool -> Bool 
xor True True = False 
xor False False = False
xor True False = True 
xor False True = True

{- Exercise 1.13 Pratical sheet 1 -}

safetail :: [a] -> [a]
safetail [] = []
safetail x = tail x

safetail' :: [a] -> [a]
safetail' x 
    | length x == 0 = [] 
    | otherwise = tail x

safetail'' :: [a] -> [a]
safetail'' x = case x of
    [] -> []
    _ -> tail x
    
{- Exercise 1.14 a) Pratical Sheet 1 -}

curta :: [a] -> Bool 
curta xs 
    | l == 0 || l == 1 || l == 2 = True
    | otherwise = False
    where l = length xs

{- Exercise 1.14 b) Pratical Sheet 1 -}

curta' :: [a] -> Bool
curta' [_] = True
curta' [_,_] = True
curta' [] = True
curta' _ = False

{- Exercise 1.15 a) Pratical sheet 1 -}

mediana :: (Ord a, Num a) => a -> a -> a -> a 
mediana a b c
    | a1 <= max c1 b1 &&  a1 >= min b1 c1 = a 
    | b1 <= max c1 a1 &&  b1 >= min a1 c1 = b 
    | c1 <= max c1 b1 &&  c1 >= min b1 a1 = c 
    where a1 = abs a 
          b1 = abs b
          c1 = abs c


{- Exercise 1.15 a) b) Pratical sheet 1 -}
mediana' :: (Ord a, Num a) => a -> a -> a -> a 
mediana' a b c = res
    where res = a + b + c - max3' a b c - min3' a b c


{- Exercise 1.16 Pratical sheet 1 -}
converte100 :: (Integral a) => a -> String
converte100 1 = "um"
converte100 2 = "dois"
converte100 3 = "tres"
converte100 4 = "quatro"
converte100 5 = "cinco"
converte100 6 = "seis"
converte100 7 = "sete"
converte100 8 = "oito"
converte100 9 = "nove"
converte100 10 = "dez"
converte100 11 = "onze"
converte100 12 = "doze"
converte100 13 = "treze"
converte100 14 = "catorze"
converte100 15 = "quinze"
converte100 16 = "dezasseis"
converte100 17 = "dezassete"
converte100 18 = "dezoito"
converte100 19 = "dezanove"
converte100 20 = "vinte"
converte100 30 = "trinta"
converte100 40 = "quarenta"
converte100 50 = "cinquenta"
converte100 60 = "sessenta"
converte100 70 = "setenta"
converte100 80 = "oitenta"
converte100 90 = "noventa"
converte100 n
    | n <= 0 = error "Numero negativo ou nulo"
    | n >= 100 = error "Numero maior ou igual a 100"
    | otherwise = (converte100 (n - (mod n 10))) ++ " e " ++ (converte100 (mod n 10))

converte1000 :: (Integral a) => a -> String
converte1000 100 = "cem"
converte1000 200 = "duzentos"
converte1000 300 = "tresentos"
converte1000 400 = "quatrocentos"
converte1000 500 = "quinhentos"
converte1000 600 = "seicentos"
converte1000 700 = "setecentos"
converte1000 800 = "oitocentos"
converte1000 900 = "novecentos"
converte1000 n
    | n <= 0 = error "Numero negativo ou nulo"
    | n >= 1000 = error "Numero maior ou igual a 1000"
    | n < 100 = converte100 n
    | n < 200 = "cento e " ++ (converte100 (mod n 100))
    | otherwise = (converte1000 (n - (mod n 100))) ++ " e " ++ (converte100 (mod n 100))

converte :: (Integral a) => a -> String
converte n
    | n <= 0 = error "Numero negativo ou nulo"
    | n >= 1000000 = error "Numero maior ou igual a 1000000"
    | n < 1000 = converte1000 n
    | n < 2000 = "mil" ++ converteAux n1000
    | otherwise = (converte1000 (div n 1000)) ++ " mil" ++ converteAux n1000
    where n1000 = mod n 1000
          converteAux n1000 = if n1000 == 0
                                then ""
                                else (if (n1000 <= 100 || mod n1000 100 == 0) then " e " else " ") ++ converte1000 n1000
