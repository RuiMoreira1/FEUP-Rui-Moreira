import Distribution.PackageDescription (mkFlagAssignment)
import Distribution.Simple.Utils (xargs)
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